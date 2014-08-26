WooCommerce-Computer-Builder
============================

<h2>Description:</h2>
A modified version of Woocommerce Custom Product Builder which works with Cart instead of its own internal query. Hopefully this version will be more customizable, compatible and faster.

<h3>Quick Q&A's</h3>
Who's this for?<br>
Anyone who wants a product customizer what reads your current products and categories and presents them in category format. Ideal for system or kit builders who know what they are looking for but like to see whats already in the cart.
Users choose what option they want and it gets added to the cart on the side bar.

Is this just for PC/Computer equipment?<br>
No, It can be used for anything which you want customer to have a choice over. Kit cars, camera packs, Even groceries?.. Maybe an idea for another project.

This looks fairly mashed up?<br>
Well, I've only been coding for a few years in PHP and recently got into WordPress development, I found WCPB (https://github.com/philippjbauer/WoocommerceProductBuilder) previously on Github, tested it and found a few issues and flaws.
As this plugin is based off that plugin, I'm putting All credit to the Author. As its not been updated for a while I'm just getting it upto scratch and modernized.

Why did I get invovled?<br>
I saw potential, and wanted something like this to work on my site. Most of the work was done, just not upto date. Naturally I wanted to learn more code and get my first plugin done.

<h3>Notes</h3>
Added a file called Tablist-woocats which will read categories from provided category ID which will show the main categories in that ID (no children), included it to not use a SQL value which tends to mess up more. Swappable in /templates/builder-page.php. Almost everything is now WooCommerce driven rather than plugin aray.

<h3>instructions</h3>
Create a main category containing your products, if not already existing.
Install plugin. 
Put the intended category to read from into Product Builder/Settings.
**Put that Category's ID in tablist-woocat.php's array (left '90' in its place for time being) (FIXED) **
And that should be it! 

<h4>Current Issues and 'working ons'</h4>
-Sorted Subcategories with Woocats, it will not show subcategory in menu, but will show products in them.<br>
-Adding Tags, helpful if you list socket types, useful product info on these.<br>
-Improve mini-cart updating. Not working with AJAX at the moment. Decided to push sidebar minicart usage to fix.<br>
-Removing lots of useless code and tidying up files.<br>
-CSS improvements
-will get a switch for plugin's base category to be set from admin page, not had time to do this yet.

To see what it looks like and our process, have a look at our main site article: http://www.littleportitservices.co.uk/our-first-plugin/
