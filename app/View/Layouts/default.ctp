<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo 'Data Archiving Management System'; ?>
	</title>
	<link rel="stylesheet" type="text/css" href="../plugins/datepicker/datepicker.css"/>
	<link rel="stylesheet" type="text/css" href="../plugins/datatables/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="../css/font-awesome-4.7.0/css/font-awesome.min.css"/>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('style.css');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script src="../js/jquery-3.1.0.min.js"></script>
	<script src="../js/common.js"></script>
	<script src="../plugins/datepicker/datepicker.js"></script>
	<script src="../plugins/datatables/datatables.net.js"></script>
	<script src="../plugins/datatables/datatables.min.js"></script>
</head>
<body>
	<main class="main-content">
		<?php echo $this->fetch('content'); ?>
	</main>
</body>
</html>
