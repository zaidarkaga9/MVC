<?php

class L_Database
{
    private $array = array();

    private  $conn;

    public function  conection()
    {
        try
        {
            $this->conn = new PDO("mysql:host=localhost;dbname=inventory","root","");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            die('');
        }
    }

    public function desconect()
    {
        $this->conn = null;
    }

    public function check($sql)
    {
			$this->conn->query("SET NAMES 'utf8'");
			$this->conn->query("SET CHARACTER SET utf8");
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->rowCount() == 1 ? true : false;
    }

    public function Number_Rows($sql)
    {
		$this->conn->query("SET NAMES 'utf8'");
		$this->conn->query("SET CHARACTER SET utf8");
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function select($sql)
    {
		$this->conn->query("SET NAMES 'utf8'");
		$this->conn->query("SET CHARACTER SET utf8");
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public  function  insert($sql)
    {
        $this->conn->query("SET NAMES 'utf8'");
		$this->conn->query("SET CHARACTER SET utf8");
        if($this->conn->exec($sql))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public  function  delete($sql)
    {
		$this->conn->query("SET NAMES 'utf8'");
		$this->conn->query("SET CHARACTER SET utf8");
        if($this->conn->exec($sql))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public  function  update($sql)
    {
		$this->conn->query("SET NAMES 'utf8'");
		$this->conn->query("SET CHARACTER SET utf8");
        if($this->conn->exec($sql))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_json($sql)
    {
		$this->conn->query("SET NAMES 'utf8'");
		$this->conn->query("SET CHARACTER SET utf8");
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function get_all($table)
    {
		$this->conn->query("SET NAMES 'utf8'");
		$this->conn->query("SET CHARACTER SET utf8");
        $stmt = $this->conn->prepare("select * from ".$table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_columns($columns,$table)
    {
		$this->conn->query("SET NAMES 'utf8'");
		$this->conn->query("SET CHARACTER SET utf8");
        $stmt = $this->conn->prepare("select ".$columns." from ".$table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_all_json($table)
    {
		$this->conn->query("SET NAMES 'utf8'");
		$this->conn->query("SET CHARACTER SET utf8");
        $stmt = $this->conn->prepare("select * from ".$table);
        $stmt->execute();
        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function get_columns_json($columns,$table)
    {
		$this->conn->query("SET NAMES 'utf8'");
		$this->conn->query("SET CHARACTER SET utf8");
        $stmt = $this->conn->prepare("select ".$columns." from ".$table);
        $stmt->execute();
        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function get_csv($sql,$filename,$columns)
    {
            $this->conn->query("SET NAMES 'utf8'");
		    $this->conn->query("SET CHARACTER SET utf8");
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $filename = "public/file/".$filename.".csv";
            $data = fopen($filename, 'w');
            fputcsv($data,$columns);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                fputcsv($data, $row);
            }
            fclose($data);
            if (file_exists($filename)) 
            {
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($filename).'"');
                readfile($filename);
                unlink($filename);
                exit;
            }
    }

    public function get_xls($sql,$filename,$columns)
    {
            $this->conn->query("SET NAMES 'utf8'");
		    $this->conn->query("SET CHARACTER SET utf8");
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $filename = "public/file/".$filename.".xls";
            $data = fopen($filename, 'w');
            fputcsv($data,$columns, "\t", '"');
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                fputcsv($data, $row, "\t", '"');
            }
            fclose($data);
            if (file_exists($filename)) 
            {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($filename).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filename));
                readfile($filename);
                unlink($filename);
                exit;
            }
    }

    public function get_json_file($sql,$filename)
    {
            $this->conn->query("SET NAMES 'utf8'");
		    $this->conn->query("SET CHARACTER SET utf8");
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $filename = "public/file/".$filename.".json";
            $data = fopen($filename, 'w');
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            file_put_contents($filename, json_encode($rows));
            fclose($data);
            if (file_exists($filename)) 
            {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($filename).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filename));
                readfile($filename);
                unlink($filename);
                exit;
            }
    }

   
}


?>