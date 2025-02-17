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

## FAQ
**1. Can I set different minimum order quantities for different products?**
Yes, the extension allows you to configure a specific minimum order quantity for each product in your store.

**2. Can I restrict minimum order quantities by customer groups?**
Yes, you can apply different minimum order quantity rules for wholesalers, retailers, and other customer groups.

**3. What happens if a customer tries to check out without meeting the minimum quantity requirement?**
The customer will receive an alert notifying them that they need to adjust their order quantity before proceeding to checkout.

**4. Does this extension support multi-store setups?**
Yes, it fully supports multi-store environments, allowing different configurations per store view.
