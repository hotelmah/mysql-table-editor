<?php

namespace MTE;

class ClsWriteFile
{
    private string $DataWrite = "";

    public function saveData($donnees, $aj_saut = true)
    {
        $this->DataWrite .= $donnees;
        if ($aj_saut) {
            $this->DataWrite .= "\n";
        }
    }

    public function initData()
    {
        $this->DataWrite = "";
    }

    public function write($file)
    {
        // chmod($file, 0777);

        $fd = fopen($file, "w+");

        if (!fwrite($fd, $this->DataWrite)) {
            return false;
        }

        fclose($fd);
        // chmod($file, 0755);

        return true;
    }
}
