<?php
require_once WEB_APP.'/model/ShowModel.class.php';

$obj = new ShowModel();

$rows = $obj->show();


require_once WEB_APP.'/view/show.html';


