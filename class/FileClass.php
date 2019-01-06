<form method = "POST" enctype="multipart/form-data">
	<input type="file" name="fileUpload">
	<button type="submit">Send</button>
</form>

<?php

class FileClass
{
	private $link;
	private $file;
	private function setLink($link)
	{
		$this->link = $link;
	}
	private function getLink()
	{
		return $this->link;
	}
	public function download()
	{
		$content = file_get_contents($this->getLink());
		$parse = parse_url($this->getLink());
		$basename = basename($parse["path"]);
		$file = fopen($basename,"w+");
		fwrite($file, $content);
		fclose($file);
		return $basename;
	}
	public function upload()
	{
		if($_SERVER["REQUEST_METHOD"]==="POST")
{
	$file = $_FILES["fileUpload"];

	if($file["error"])
	{
		throw new Exception("Error: " . $file["error"]);
	}
	$dirUploads = "uploads";
	if(!is_dir($dirUploads))
	{
		mkdir($dirUploads);
	}
	if(move_uploaded_file($file["tmp_name"],$dirUploads. DIRECTORY_SEPARATOR . $file["name"]))
	{
		echo "Upload realizado com sucesso!";

	}else
	{
		throw new Exception("Não foi possivel realizar o upload.");
	}
}
	}
	public function __construct($link)
	{
		$this->setLink($link);
	}
}

?>
