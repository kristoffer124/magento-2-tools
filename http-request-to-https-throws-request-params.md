When working with proxies e.g. when testing callbacks some

```
class Magento\Framework\HTTP\PhpEnvironment\Request extends \Zend\Http\PhpEnvironment\Request
{
...
    public function isSecure()
    {
        return true;
        if ($this->immediateRequestSecure()) {
            return true;
        }

        return $this->initialRequestSecure($this->getSslOffloadHeader());
    }
...
}
```