<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jitsi Video Conference</title>
</head>
<body>
    <h1>Jitsi Meet Video Conference</h1>

    <div id="meet"></div>

    <script src="https://meet.jit.si/external_api.js"></script>
    <script>
        const domain = "meet.jit.si";
        const options = {
            roomName: "{{ auth()->user()->id }}_ConferenceRoom", // Change this to a unique room name
            width: '100%',
            height: 700,
            parentNode: document.querySelector('#meet'),
            userInfo: {
                displayName: "{{ auth()->user()->name }}" // Use authenticated user's name
            }
        };
        const api = new JitsiMeetExternalAPI(domain, options);
    </script>
</body>
</html>
