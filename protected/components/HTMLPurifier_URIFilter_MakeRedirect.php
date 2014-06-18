<?php
class HTMLPurifier_URIFilter_MakeRedirect extends HTMLPurifier_URIFilter
{
    /**
     * @type string
     */
    public $name = 'MakeRedirect';

    /**
     * @type array
     */
    protected $ourHostParts = false;

    /**
     * @param HTMLPurifier_Config $config
     * @return void
     */
    public function prepare($config)
    {
        //$our_host = $config->getDefinition('URI')->host;//H::p($_SERVER['SERVER_NAME']);
        if ($our_host !== null) {
            $this->ourHostParts = array_reverse(explode('.', $our_host));
        }
    }

    /**
     * @param HTMLPurifier_URI $uri Reference
     * @param HTMLPurifier_Config $config
     * @param HTMLPurifier_Context $context
     * @return bool
     */
    public function filter(&$uri, $config, $context)
    {
        if (is_null($uri->host)) {
            return true;
        }
        if ($this->ourHostParts === false) {
            return false;
        }
        $host_parts = array_reverse(explode('.', $uri->host));
        foreach ($this->ourHostParts as $i => $x) {
            if (!isset($host_parts[$i]) || $host_parts[$i] != $this->ourHostParts[$i]) {
                //$path = Yii::app()->createUrl('site/redirect');
                //$query = 'url='.urlencode($uri->toString());
                //$uri = new HTMLPurifier_URI('http', null, 'advists.com', null, $path, $query, null);
                break;//Yii::app()->request->getServerName(), // return $_SERVER['SERVER_NAME']
            }
        }
        return true;
    }
}