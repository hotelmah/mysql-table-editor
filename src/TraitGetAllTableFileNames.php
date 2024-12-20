<?php

namespace MySQLTableEditor;

// trait.get.all.table.file.names

trait TraitGetAllTableFileNames
{
    public function getAllTableFileNames(string $TempCurrentWorkDir, string $TempSearchString, bool $TempRemoveExtension = false): array
    {
        $TempAryWholeDirectory = array();
        $TempAryValidFiles = array();
        $TempAryMTEFiles = array();

        $TempAryWholeDirectory = array_slice(array_diff(scandir($TempCurrentWorkDir), array('..', '.', '.DS_Store')), 0);

        foreach ($TempAryWholeDirectory as $TempAryDirectoryItem) {
            if (preg_match('/(.*(\.php))$/', $TempAryDirectoryItem)) {
                array_push($TempAryValidFiles, $TempAryDirectoryItem);
            }
        }

        foreach ($TempAryValidFiles as $TempAryValidFile) {
            if (preg_match($TempSearchString, file_get_contents($TempAryValidFile))) {
                if ($TempRemoveExtension) {
                    array_push($TempAryMTEFiles, explode('.', $TempAryValidFile)[0]);
                } else {
                    array_push($TempAryMTEFiles, $TempAryValidFile);
                }
            }
        }

        unset($TempAryWholeDirectory);
        unset($TempAryValidFiles);

        return array_combine($TempAryMTEFiles, $TempAryMTEFiles);
    }
}
