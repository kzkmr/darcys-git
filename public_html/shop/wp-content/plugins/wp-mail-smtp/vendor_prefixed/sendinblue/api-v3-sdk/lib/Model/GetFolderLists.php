<?php

/**
 * GetFolderLists
 *
 * PHP version 5
 *
 * @category Class
 * @package  SendinBlue\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
/**
 * SendinBlue API
 *
 * SendinBlue provide a RESTFul API that can be used with any languages. With this API, you will be able to :   - Manage your campaigns and get the statistics   - Manage your contacts   - Send transactional Emails and SMS   - and much more...  You can download our wrappers at https://github.com/orgs/sendinblue  **Possible responses**   | Code | Message |   | :-------------: | ------------- |   | 200  | OK. Successful Request  |   | 201  | OK. Successful Creation |   | 202  | OK. Request accepted |   | 204  | OK. Successful Update/Deletion  |   | 400  | Error. Bad Request  |   | 401  | Error. Authentication Needed  |   | 402  | Error. Not enough credit, plan upgrade needed  |   | 403  | Error. Permission denied  |   | 404  | Error. Object does not exist |   | 405  | Error. Method not allowed  |   | 406  | Error. Not Acceptable  |
 *
 * OpenAPI spec version: 3.0.0
 * Contact: contact@sendinblue.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.12
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */
namespace WPMailSMTP\Vendor\SendinBlue\Client\Model;

use ArrayAccess;
use WPMailSMTP\Vendor\SendinBlue\Client\ObjectSerializer;
/**
 * GetFolderLists Class Doc Comment
 *
 * @category Class
 * @package  SendinBlue\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class GetFolderLists implements \WPMailSMTP\Vendor\SendinBlue\Client\Model\ModelInterface, \ArrayAccess
{
    const DISCRIMINATOR = null;
    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = 'getFolderLists';
    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerTypes = ['lists' => 'object[]', 'count' => 'int'];
    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerFormats = ['lists' => null, 'count' => 'int64'];
    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }
    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }
    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = ['lists' => 'lists', 'count' => 'count'];
    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = ['lists' => 'setLists', 'count' => 'setCount'];
    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = ['lists' => 'getLists', 'count' => 'getCount'];
    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }
    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }
    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }
    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }
    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];
    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['lists'] = isset($data['lists']) ? $data['lists'] : null;
        $this->container['count'] = isset($data['count']) ? $data['count'] : null;
    }
    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];
        return $invalidProperties;
    }
    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return \count($this->listInvalidProperties()) === 0;
    }
    /**
     * Gets lists
     *
     * @return object[]
     */
    public function getLists()
    {
        return $this->container['lists'];
    }
    /**
     * Sets lists
     *
     * @param object[] $lists lists
     *
     * @return $this
     */
    public function setLists($lists)
    {
        $this->container['lists'] = $lists;
        return $this;
    }
    /**
     * Gets count
     *
     * @return int
     */
    public function getCount()
    {
        return $this->container['count'];
    }
    /**
     * Sets count
     *
     * @param int $count Number of lists in the folder
     *
     * @return $this
     */
    public function setCount($count)
    {
        $this->container['count'] = $count;
        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }
    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (\is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }
    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }
    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (\defined('JSON_PRETTY_PRINT')) {
            // use JSON pretty print
            return \json_encode(\WPMailSMTP\Vendor\SendinBlue\Client\ObjectSerializer::sanitizeForSerialization($this), \JSON_PRETTY_PRINT);
        }
        return \json_encode(\WPMailSMTP\Vendor\SendinBlue\Client\ObjectSerializer::sanitizeForSerialization($this));
    }
}
