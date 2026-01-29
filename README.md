# Magento 2 Minimum Order Quantity by BSS Commerce

**[Magento 2 Minimum Order Quantity](https://bsscommerce.com/magento-2-minimum-order-quantity-extension.html)** (MOQ) is an essential feature for wholesalers, ensuring cost-effectiveness and maintaining profit margins. However, Magento’s default settings only allow sellers to set minimum and maximum quantities per product rather than for the entire order.

With the right extension, you can go beyond default limitations and gain full control over order quantity restrictions per customer group.

## Main Features

* **Set Minimum Total Order Quantity per Customer Group**: Define the minimum number of items required in the shopping cart for different customer groups, ensuring bulk purchases meet profitability targets.

* **Set Maximum Total Order Quantity per Customer Group**: Prevent excessively large orders that could disrupt stock management by setting an upper limit on total order quantity per customer group.

* **Customizable MOQ Notification Messages**: Display tailored messages to inform customers about MOQ requirements, improving transparency and reducing abandoned carts.

Experience It Yourself!

See how the Magento 2 Limit Cart Quantity extension works in real-time. Try the demo now and explore all features firsthand!

**[Frontend Demo Luma](http://limit-cart-quantity.demom2.bsscommerce.com/overnight-duffle.html)** | **[Backend Demo Luma](https://limit-cart-quantity.demom2.bsscommerce.com/admin/admin/index/index/key/2cef55dc770ff2ccf5ee5b67bc8f1a09dffb3f8a5b4738a0d47741feb592119f/)**

## Installation
**1. Step 1: Extract the Extension Package**

Unzip the downloaded extension file on your local system.

**Step 2: Create the Module Directory**

* Navigate to your Magento 2 installation root directory.
* Inside the `app/code/Bss/ folder`, create a new directory named `Limitcartqty/`.
* The module’s internal identifier, Limitcartqty, is defined in the "psr-4" section of the composer.json file inside the extension package.

**Step 3: Upload the Extension Files**

* Copy all extracted files from the extension package into the newly created `app/code/Bss/Limitcartqty/ directory`.
* Ensure the folder structure aligns with Magento's standard directory format.

**Step 4: Run Setup Upgrade**

* Navigate to your Magento 2 root directory and execute:
```
php bin/magento setup:upgrade
```
**Step 5: Deploy Static Content**

* Run the following command to deploy static files:
```
php bin/magento setup:static-content:deploy
```

**Step 6: Clear Cache**

Flush the cache to apply the changes:
```
php bin/magento cache:flush
```
**Verification**

Navigate to Stores > Configuration > BSS Commerce > Limit Cart Quantity to check if the module is active.

## Configuration Guide

### 1. Configure Minimum Order Quantity for Entire Cart

**Set the Minimum Order Quantity**

In the Minimum Quantity Allowed for Entire Cart section:
* Locate the Customer Group column: Each row contains a dropdown list displaying all available customer groups. Select the group you want to apply the minimum quantity to.
* In the Minimum Qty column: Enter the minimum number of total units required in the cart for the selected customer group.
* In the Action column: Click the trash bin icon to remove the minimum quantity rule for a customer group.
* Click Add Minimum Qty to create additional rules for more customer groups.

**Customize the Minimum Order Quantity Alert Message**

* In the Message Alert for Minimum Value field, enter a custom message to notify customers when they do not meet the minimum quantity requirement.
* Use placeholders:

-conf- (configuration value) to dynamically insert the required minimum quantity.

-cart- (cart value) to show the current cart quantity.

### 2. Configure Maximum Order Quantity for Entire Cart

Follow the same steps to configure the maximum order quantity.

For detailed documentation, visit: **[User Guide](https://wiki.bsscommerce.com/docs/magento-2-check-out-extensions/magento-2-limit-cart-quantity/user-guide/)**

## 5. Other helpful Magento 2 Extensions by BSSCommerce


☞ [Shipping and Payment Method per Customer Group](https://bsscommerce.com/magento-2-shipping-and-payment-method-per-customer-group-extension.html): Assign specific shipping and payment methods for each customer group.

☞ [Shopping Cart Price Rule per Store View](https://bsscommerce.com/magento-2-shopping-cart-price-rule-per-store-view-extension.html): Create flexible pricing and promotion rules tailored for each store view.

☞ [Tax per Store View](https://bsscommerce.com/magento-2-tax-per-store-view-extension.html): Set up different tax configurations for products across various store views.

☞ [Admin Product Preview Plus](https://bsscommerce.com/magento-2-admin-product-preview-plus-extension.html): Quickly preview frontend product pages from the admin panel.

☞ [Admin Action Log](https://bsscommerce.com/magento-2-admin-action-log-extension.html): Track and log all administrative changes related to product rules and order management.

☞ [Quick Order](https://bsscommerce.com/magento-2-wholesale-fast-order-extension.html): Allow customers to add multiple products to cart quickly using SKU or CSV upload.

☞ [Request for Quote](https://bsscommerce.com/magento-2-request-for-quote-extension.html): Let B2B customers request quotes for custom orders directly from the store.

☞ [Product Labels](https://bsscommerce.com/magento-2-product-label-extension.html): Highlight special offers, new products, or best sellers with customizable labels.

☞ [Out of Stock Notification](https://bsscommerce.com/magento-2-out-of-stock-notification-extension.html): Notify customers automatically when out-of-stock products become available.

☞ [Reward Points](https://bsscommerce.com/magento-2-reward-points-extension.html): Implement a loyalty system with points, rewards, and redemption options.

☞ [Multiple Wishlists](https://bsscommerce.com/magento-2-multiple-wishlists-extension.html): Let customers create and manage multiple wishlists for different purposes.

☞ [Ajax Add To Cart](https://bsscommerce.com/magento-2-ajax-add-to-cart-extension.html): Improve shopping experience with fast, AJAX-powered add-to-cart and cart updates.

☞ [Magento 2 B2B Extension Package](https://bsscommerce.com/magento-2-b2b-extensions-package.html): Comprehensive and scalable B2B functionalities designed for both B2B-only and hybrid B2B & B2C stores, including corporate accounts, tiered pricing, quick order forms, custom approval workflows, personalized shipping and payment methods, quote management, and more.


Explore more [Magento 2 extensions](https://bsscommerce.com/magento-2-extensions.html) to enhance product management, performance, and customer experience.


## FAQ
**1. Can I set different minimum order quantities for different products?**
Yes, the extension allows you to configure a specific minimum order quantity for each product in your store.

**2. Can I restrict minimum order quantities by customer groups?**
Yes, you can apply different minimum order quantity rules for wholesalers, retailers, and other customer groups.

**3. What happens if a customer tries to check out without meeting the minimum quantity requirement?**
The customer will receive an alert notifying them that they need to adjust their order quantity before proceeding to checkout.

**4. Does this extension support multi-store setups?**
Yes, it fully supports multi-store environments, allowing different configurations per store view.
