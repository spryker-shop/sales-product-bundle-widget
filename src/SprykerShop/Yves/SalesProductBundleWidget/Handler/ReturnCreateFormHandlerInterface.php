<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\SalesProductBundleWidget\Handler;

use Generated\Shared\Transfer\ReturnCreateRequestTransfer;

interface ReturnCreateFormHandlerInterface
{
    public function handleFormData(array $returnItemList, ReturnCreateRequestTransfer $returnCreateRequestTransfer): ReturnCreateRequestTransfer;
}
