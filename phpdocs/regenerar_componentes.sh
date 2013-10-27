 #!/bin/bash
rm -rf componentes-osti/*
phpdoc run -f ../system/helpers/componentes_html_helper.php -t ./componentes-osti
echo "******* Listo! La documentacion de los componentes ha sido regenerada ... "

