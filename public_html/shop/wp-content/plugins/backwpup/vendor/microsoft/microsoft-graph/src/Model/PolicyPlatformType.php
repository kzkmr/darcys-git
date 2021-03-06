<?php
/**
* Copyright (c) Microsoft Corporation.  All Rights Reserved.  Licensed under the MIT License.  See License in the project root for license information.
* 
* PolicyPlatformType File
* PHP version 7
*
* @category  Library
* @package   Microsoft.Graph
* @copyright © Microsoft Corporation. All rights reserved.
* @license   https://opensource.org/licenses/MIT MIT License
* @version   GIT: 1.4.0
* @link      https://graph.microsoft.io/
*/
namespace Microsoft\Graph\Model;

use Microsoft\Graph\Core\Enum;

/**
* PolicyPlatformType class
*
* @category  Model
* @package   Microsoft.Graph
* @copyright © Microsoft Corporation. All rights reserved.
* @license   https://opensource.org/licenses/MIT MIT License
* @version   Release: 1.4.0
* @link      https://graph.microsoft.io/
*/
class PolicyPlatformType extends Enum
{
    /**
    * The Enum PolicyPlatformType
    */
    const ANDROID = "android";
    const I_OS = "iOS";
    const MAC_OS = "macOS";
    const WINDOWS_PHONE81 = "windowsPhone81";
    const WINDOWS81_AND_LATER = "windows81AndLater";
    const WINDOWS10_AND_LATER = "windows10AndLater";
    const ANDROID_WORK_PROFILE = "androidWorkProfile";
    const ALL = "all";
}