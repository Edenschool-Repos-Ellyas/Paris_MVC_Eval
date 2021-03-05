<?php
	/**
	 * Class Pages
	 * Gère les pages statiques
	 */
	class Ajaxs extends Controller {

		private $ajaxModel;

		/**
		 * Posts constructor
		 * Charge le model des articles
		 */
		public function __construct() {
			$this->ajaxModel = $this->loadModel('Article');
		}

        public function hintAjax($hint)
        {
			$articles = $this->ajaxModel->findAllArticlesWithHint($hint);
            
			$data = [
				"articles" => $articles,
			];

            $this->render("ajaxs/searchBar", $data);
        }
	}
