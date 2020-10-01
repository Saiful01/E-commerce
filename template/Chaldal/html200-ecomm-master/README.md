# Description

This is an assignment to build a responsive ecommerce web page. Product information is in array of JSON objects. Nav and product container div will use flexbox. Sidebar/aside is a module that changes layout and location based on window size. Clicking a product's “add to cart” or “remove from cart” button updates cart count at top. User can sort items by selecting an attribute and submitting the form at top of page. Product images are served at appropriate sizes for user's device.

Students may use the provided mockups to guide their design to whatever extent they like. Matching the mockups is not required.

## Provided Materials

  - basic HTML and CSS
  - JSON list of products in script.js file
  - reset.css
  - images for all products
  - suggested design mockups

## Weekly Assignments

Week4: Write code to loop through items JSON and print out "name" and "price" attributes for each object to the console. Code HTML for a single item in `<div class="item">`. Use dummy content or some pulled from one of the JSON objects for the name, description, and price. This is a template that we'll later use when we populate the page with all the objects. 

Week5: Code basic CSS for page, creating a fluid if not yet responsive layout. Implement a responsive grid system of your own design, or use a library, or don't use a grid at all. Be sure all important size values are proportional (em, rem, %). Nav and item-container elements should be styled as flexbox containers.

Week6: Serve appropriately sized images for user's device. 

Week7: Using media queries, change layouts/style based on device size.

Week8: Write functions to add/remove items from cart; sort items by selected attribute.

Week9: Write code that causes add/remove function to be triggered on click of "add" and "remove" buttons; submission of filter form triggers items to sort by appropriate attribute; on page load, all items in list are displayed on page.

Extra Challenge: Incorporate unit tests! Guide: https://gist.github.com/cherimarie/8f57a32553382c5b1e5428bd79a13626

## Requirements

  - Site layout looks good on all sizes of devices. At a minimum, elements are proportionally styled and aside element changes location and layout at different screen sizes. This should be tested using a variety of devices and at least one online browser compatiblity testing tool.
  - The page is populated with items via Javascript building HTML with attributes from JSON data.
  - Nav and product container elements are styled using flexbox.
  - Appropriately sized images are served up based on size of user's device.
  - User can add and remove items from their cart, which changes cart count number at top of page.
  - Products can be sorted by different attributes using the filter form.
  - This README is updated to include information about the testing steps taken to ensure site quality.
  - Site is live on GH Pages hosting.
  
## Grading
Each weekly assignment will be graded independently. There will not be a final grade for the entire project. 
