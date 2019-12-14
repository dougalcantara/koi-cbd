ssh -t koicbdstaging@koicbdstaging.ssh.wpengine.net  'cd /home/wpe-user/sites/koicbdstaging/wp-content/themes/;rm -rf KOI-2019/*;exit;bash'
rsync -r --progress --exclude=".*" --exclude="node_modules" ./ koicbdstaging@koicbdstaging.ssh.wpengine.net:/home/wpe-user/sites/koicbdstaging/wp-content/themes/KOI-2019
