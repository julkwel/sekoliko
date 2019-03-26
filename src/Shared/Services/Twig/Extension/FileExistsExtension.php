<?php

namespace App\Shared\Services\Twig\Extension;

class FileExistsExtension extends \Twig_Extension
{
    /**
     * Return the functions registered as twig extensions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('file_exists', 'file_exists'),
        );
    }

    public function getName()
    {
        return 'sk_twig';
    }
}
