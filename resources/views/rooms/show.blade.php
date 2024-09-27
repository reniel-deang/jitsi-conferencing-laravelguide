<h1>Room: {{ $room->room_name }}</h1>
<div id="meet"></div>

<script src="https://meet.jit.si/external_api.js"></script>
<script>
    const domain = "meet.jit.si";
    const options = {
        roomName: "{{ $room->room_name }}",
        width: '100%',
        height: 700,
        parentNode: document.querySelector('#meet'),
        userInfo: {
            displayName: "{{ auth()->user()->name }}"
        },
        interfaceConfigOverwrite: {
            TOOLBAR_BUTTONS: [
                'microphone', 'camera', 'desktop', 'recording', 'participants-pane', 
                'mute-everyone' // Moderation controls
            ],
            SHOW_JITSI_WATERMARK: false,
            SHOW_BRAND_WATERMARK: false,
            DEFAULT_LOCAL_DISPLAY_NAME: 'You',
        }
    };

    const api = new JitsiMeetExternalAPI(domain, options);

    @if($isModerator)
        // Grant moderator rights to the room creator
        api.addEventListener('participantRoleChanged', function(event) {
            if (event.role === 'moderator') {
                console.log('User is now a moderator');
            } else {
                api.executeCommand('password', 'moderatorPassword'); // Set a password or moderator options
            }
        });
    @endif
</script>
