<?php
# CLIENT ID
# https://i.imgur.com/GHI2ts5.png (screenshot)
$client_id = "218485827620175872";

# CLIENT SECRET
# https://i.imgur.com/r5dYANR.png (screenshot)
$secret_id = "MjE4NDg1ODI3NjIwMTc1ODcy.V79myA.5LrEqfIuzcfrlRQR2sXaoE8zZt0";

# SCOPES SEPARATED BY + SIGN
# example: identify+email+guilds+connections
# $scopes = "identify+email";
$scopes = "identify+email+guilds+connections";

# REDIRECT URL
# example: https://mydomain.com/includes/login.php
# example: https://mydomain.com/test/includes/login.php
$redirect_url = "https://localhost/social/discord/demos/simple-demo/includes/login.php";

# IMPORTANT READ THIS:
# - Set the `$bot_token` to your bot token if you want to use guilds.join scope to add a member to your server
# - Check login.php for more detailed info on this.
# - Leave it as it is if you do not want to use 'guilds.join' scope.

# https://i.imgur.com/2tlOI4t.png (screenshot)
$bot_token = null;
