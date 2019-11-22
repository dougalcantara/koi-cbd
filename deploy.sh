rm -rf node_modules
ssh -t koicbddev@koicbddev.ssh.wpengine.net  'cd /home/wpe-user/sites/koicbddev/wp-content/themes/;rm -rf KOI-2019/*;exit;bash'
rsync -r --progress --exclude=".*" ./ koicbddev@koicbddev.ssh.wpengine.net:/home/wpe-user/sites/koicbddev/wp-content/themes/KOI-2019