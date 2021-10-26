<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\SalesProductBundleWidget\Extractor;

class ItemExtractor implements ItemExtractorInterface
{
    /**
     * @uses \Spryker\Client\ProductBundle\Grouper\ProductBundleGrouper::BUNDLE_ITEMS
     *
     * @var string
     */
    protected const BUNDLE_ITEMS = 'bundleItems';

    /**
     * @uses \Spryker\Client\ProductBundle\Grouper\ProductBundleGrouper::BUNDLE_PRODUCT
     *
     * @var string
     */
    protected const BUNDLE_PRODUCT = 'bundleProduct';

    /**
     * @param iterable<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return array
     */
    public function extractBundleItems(iterable $itemTransfers): array
    {
        $productBundles = $this->getIndexedProductBundles($itemTransfers);
        $bundleItems = [];

        foreach ($itemTransfers as $itemTransfer) {
            $relatedBundleItemIdentifier = $itemTransfer->getRelatedBundleItemIdentifier();
            if (!$relatedBundleItemIdentifier) {
                continue;
            }

            if (!isset($bundleItems[$relatedBundleItemIdentifier])) {
                $bundleItems[$relatedBundleItemIdentifier] = [
                    static::BUNDLE_PRODUCT => $productBundles[$relatedBundleItemIdentifier],
                    static::BUNDLE_ITEMS => [],
                ];
            }

            $bundleItems[$relatedBundleItemIdentifier][static::BUNDLE_ITEMS][] = $itemTransfer;
        }

        return $bundleItems;
    }

    /**
     * @param iterable<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return array<\Generated\Shared\Transfer\ItemTransfer>
     */
    protected function getIndexedProductBundles(iterable $itemTransfers): array
    {
        $productBundles = [];

        foreach ($itemTransfers as $itemTransfer) {
            $productBundle = $itemTransfer->getProductBundle();
            if (!$productBundle) {
                continue;
            }

            $productBundles[$productBundle->getBundleItemIdentifier()] = $productBundle;
        }

        return $productBundles;
    }
}
