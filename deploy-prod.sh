ssh -t koihealth@koihealth.ssh.wpengine.net  'cd /home/wpe-user/sites/koihealth/wp-content/themes/;rm -rf KOI-2019/*;exit;bash'
rsync -r --progress --exclude=".*" --exclude="node_modules" ./ koihealth@koihealth.ssh.wpengine.net:/home/wpe-user/sites/koihealth/wp-content/themes/KOI-2019
