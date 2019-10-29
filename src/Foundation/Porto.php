<?php

namespace Porto\Foundation;

use Porto\Traits\CallableTrait;
use Symfony\Component\Finder\SplFileInfo;

class Porto
{
    use CallableTrait;

    /**
     * @param SplFileInfo $file
     * @return mixed|string
     */
    public function getClassFromFile(SplFileInfo $file)
    {
        $contents = $file->getContents();

        $gettingNamespace = $gettingClass = false;
        $namespace = $class = "";

        foreach (token_get_all($contents) as $token) {
            if (is_array($token) && $token[0] == T_NAMESPACE) {
                $gettingNamespace = true;
            }

            if (is_array($token) && $token[0] == T_CLASS) {
                $gettingClass = true;
            }

            if ($gettingNamespace === true) {
                if (is_array($token) && in_array($token[0], [T_STRING, T_NS_SEPARATOR])) {
                    $namespace .= $token[1];
                } else if ($token === ';') {
                    $gettingNamespace = false;
                }
            }

            if ($gettingClass === true) {
                if (is_array($token) && $token[0] == T_STRING) {
                    $class = $token[1];
                    break;
                }
            }
        }

        return $namespace ? $namespace . '\\' . $class : $class;
    }
}
