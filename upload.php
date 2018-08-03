<?php

if (isset($_POST['submit'])) {
	$file = $_FILES['file'];
	
	$fileName = $file['name'];
	$fileType = $file['type'];
	$fileTmpName = $file['tmp_name'];
	$fileError = $file['error'];
	$fileSize = $file['size'];

	$fileExt = explode(".", $fileName);
	$fileActualExt = strtolower(end($fileExt));
	$allowed = array("jpg", "jpeg", "png", "pdf");

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 1) {
			echo "There was an error while uploading this file!";
			exit();
		} else {
			if ($fileSize > 1000000) {
				echo "You cannot upload a file this big!";
				exit();
			} else {
				$newFileName = uniqid("", true) . "." . $fileActualExt;
				$fileDestination = "uploads/" . $newFileName;
				move_uploaded_file($fileTmpName, $fileDestination);
				header("Location: index.php?upload=success");
				exit();
			}
		}
	} else {
		echo "You cannot upload a file of this type";
		exit();
	}
} else {
	header("Location: index.php");
	exit();
}