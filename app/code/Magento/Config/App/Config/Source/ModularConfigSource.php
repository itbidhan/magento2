<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Config\App\Config\Source;

use Magento\Framework\App\Config\ConfigSourceInterface;
use Magento\Framework\DataObject;
use Magento\Framework\App\Config\Initial\Reader;

/**
 * Class for retrieving initial configuration from modules
 */
class ModularConfigSource implements ConfigSourceInterface
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Get initial data
     *
     * @param string $path Format is scope type and scope code separated by slash: e.g. "type/code"
     * @return array
     */
    public function get($path = '')
    {
        $data = new DataObject($this->reader->read());
        if ($path !== '') {
            $path = '/' . $path;
        }
        return $data->getData('data' . $path) ?: [];
    }
}
