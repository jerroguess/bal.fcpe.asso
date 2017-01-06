<?PHP

/*
  --------------------------------------------------------------------
  class.bo.ajax.imagesecurite.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */
/*
    Modification de la taille de l'image et du texte pour les rendre plus lisible effectuer par Yvon Abale en Decembre 2016
*/
class boacImageSecuriteController extends boActionAjaxController {
    # ******************************
    # Constructeurs.
    # ******************************

    public function __construct(boRequest $request, boResponse $response) {

        // 1. Appel du constructeur de la classe parente
        parent::__construct($request, $response);
    }

    # ******************************
    # Chargement des variables.
    # ******************************

    protected function _loadVar() {
        $this->_request->defineParam(0, 'reference', '');
    }

    # ******************************
    # Actions.
    # ******************************

    public function execute() {

        // Entête de fichier.
        header('Content-Type: /image/jpeg');
        
        // Récuperation des variables.
        $strReference = $this->_request->getParamByKey('reference');
        // Sélection du texte.
        $boSecurity = new common_Security($this->_connection);
        $strTexte = $boSecurity->getTextByReference($strReference);


        // Font selectionnée.
        $font = "public/fonts/courbd.ttf"; //REP_FONT_PATH . "courbd.ttf";
		
        // Background selectionné.
        $bgurl = rand(1, 10);
        $im = ImageCreateFromPNG(IMAGE_TURING_PATH . "bg" . $bgurl . ".png");


        // Création aléatoire de la taille, angle, et couleur noire.
        $size = rand(20, 20);           // par defaut (12, 16)
        $angle = 1;                     // par defaut rand(-5, 5);
        $color = ImageColorAllocate($im, rand(0, 100), rand(0, 100), rand(0, 100));

        // Determination de la taille du texte, et utilisation des dimension pour générer les coordonnées x et y.
        $textsize = imagettfbbox($size, $angle, $font, $strTexte);
        $twidth = abs($textsize[2] - $textsize[0]);
        $theight = abs($textsize[5] - $textsize[3]);
        $x = (imagesx($im) / 2) - ($twidth / 2) + (rand(-20, 20));
        $y = (imagesy($im)) - ($theight / 2);

        // Ajout du texte à l'image.
        ImageTTFText($im, $size, $angle, $x, $y, $color, $font, $strTexte);

        // Affichage de l'image en jpeg.
        imagejpeg($im, NULL, 100);

        // Destruction de l'image en mémoire.
        //imagedestroy($im);                                     // commenté a cause d'une erreur, revenir dessus une fois le travail terminé.
    }
}

?>