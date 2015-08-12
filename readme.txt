=== TG Email Protection ===
Contributors: ashokdhamija
Donate link: http://www.tekgazet.com
Tags: email, email protection, obfuscate, email obfuscation, obfuscator, security, spam, spambot, spammers, email address, mailto, email spiders
Requires at least: 3.0.1
Tested up to: 4.2.4
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Protect email addresses from being harvested by spammers and spambots, obfuscating them. Your visitors can still see email addresses.

== Description ==

Unsolicited email or email spam is a huge problem that netizens have to face on daily basis. It is estimated that about 90% of all emails sent are spam mails. It was estimated that spam cost businesses to the order of $100 billion in the year 2007 [source: Wikipedia]. Spammers use email harvesting spambots or email spider software to automatically collect email addresses displayed on websites. Therefore, displaying email addresses on your websites can be an invitation to the spammers to collect your email addresses and then start sending you spam mail. At the same, it may be necessary to show your contact email addresses to the genuine visitors to your website. So, what is the solution?

TG Email Protection plugin provides a solution to this issue. Obfuscate or hide the email addresses from the spambots or email spider software, while at the same time displaying the same email addresses to the genuine visitors. Thus, while genuine visitors can see your contact and support email addresses and other email addresses displayed on your websites, the email spider software and spambots cannot automatically harvest your email addresses. For this to happen, obfuscation is used to hide the email addresses included in your WordPress website or blog from spambots and email spider software. This plugin uses different methods to achieve this twin objective in order to fight spam mail and to protect your email addresses. More methods of obfuscating email addresses to conceal them from email spambots may be added to the plugin in future.

How does the plugin obfuscate an email address? In fact, the plugin uses fast and efficient search of the content being delivered, to search for all email addresses in your content and then to obfuscate them on-the-fly. It happens whenever a page is about to be delivered to your visitor. The contents of your database are NOT changed by the plugin. What the plugin does is something like this: when a visitor requests a post or page to be displayed in the browser (by visiting its URL), WordPress extracts the relevant contents from the database; it is at this time that this plugin steps in and filters these contents in a fast and efficient manner, searching and obfuscating the email addresses found in such contents which have already been extracted or copied from the database. Thus, the contents of your database are not changed at all by this plugin. Only the (copy of the) contents being shown to the visitors are shown in a different (obfuscated) manner. While the visitor will still see the email address as usual, it will be obfuscated or hidden from the email spambots and spider software.

**Two options to obfuscate email addresses**

TG Email Protection plugin offers two different options for obfuscating your email addresses, while at the same time displaying them to the genuine visitors:

* Select to automatically obfuscate all email addresses shown on your website. When this option is selected, the plugin will obfuscate all email addresses in your content being delivered to the visitors on-the-fly. When this option is selected, you may still separately and individually disable (or enable) obfuscation of email addresses from specific parts of your contents being delivered, such as the main contents, title, excerpts and comments of the post or page, and also from the blog description / information and widget texts. Email addresses in mailto: format are also supported with this option.
* Use a shortcode to selectively protect or obfuscate each individual email address that you want. Shortcode can be used only when the above setting for automatic obfuscation of email addresses on the website is NOT selected; otherwise, shortcode will NOT do anything. So, please use shortcode only with this understanding. This is for the obvious reason that where you have already selected the option to obfuscate all email addresses on your website, all email addresses are in any case being obfuscated so that there is no need to use shortcode to obfuscate an individual email address.  To use shortcode, use format like this: [tgemail]person@example.com[/tgemail], where person@example.com is the email being obfuscated. Put this shortcode in any of your posts, pages or widgets, wherever you want to display the email address. Please do NOT use shortcode for email in mailto: format.

**Additional options of changing @ and . (DOT) symbols in email addresses:**

TG Email Protection plugin provides you an additional (optional) measure to further obfuscate the email addresses by replacing the @ and . (DOT) symbols in email addresses by something like ' (AT) ' and ' (DOT) ' respectively or some other similar text to be chosen by you. While a user can obviously understand what such text stands for, an email spambot may not be able to know that, more so if you use your own custom text which can properly explain its purpose of replacing the @ and . (DOT) symbols in email addresses.

Once installed, the settings of the TG Email Protection plugin would be available for being changed from the 'TG Email Protection' option in the 'Settings' menu on the admin screen (back-end) of your WordPress website or blog.

Detailed instructions have been provided on the settings / options page of TG Email Protection plugin in the admin area. Each setting has been explained in detail.

You can use this plugin and test the results of obfuscating the email addresses from spambots. In our extensive tests conducted with several email spiders and spambot software, we have found that this plugin is completely successful in hiding the email addresses from the spammers by using innovative and randomized techniques.

This plugin works on all WordPress websites or blogs. It is a very light-weight plugin.

**About the plugin and our other plugins:**

This plugin has been developed by [Ashok Dhamija](http://tilakmarg.com/dr-ashok-dhamija/), who has also developed few other plugins, such as the following:

* [TG Facebook Comments](https://wordpress.org/plugins/tg-facebook-comments/).
* [TG Copy Protection](https://wordpress.org/plugins/tg-copy-protection/).
* [TG Customized Tags](https://wordpress.org/plugins/tg-customized-tags/).

== Installation ==

1. Upload the 'tg-email-protection' folder to the '/wp-content/plugins/' folder on your website server.
2. It will show as installed plugin. Then, activate the plugin through the 'Plugins' menu in WordPress admin page.
3. You can also use the 'Add New' command on the 'Plugins' menu in WordPress admin page. Thereafter, search this plugin from the search-box. Or, alternatively, click the 'Upload Plugin' button to upload the zip file for this plugin (tg-email-protection.zip), and then follow on-screen instructions to install and activate the plugin.

== Frequently Asked Questions ==

= Will this plugin change the contents of my WordPress database by changing the email addresses therein permanently? =

No. Not at all. The contents of your database are NOT changed by the plugin. What the plugin does is something like this: when a visitor requests a post or page to be displayed in the browser (by visiting its URL), WordPress extracts the relevant contents from the database; it is at this time that this plugin steps in and filters these contents in a fast and efficient manner, searching and obfuscating the email addresses found in such contents which have already been extracted from the database. Thus, the contents of your database are not changed at all by this plugin. Only the (copy of the) contents being shown to the visitors are shown in a different (obfuscated) manner. While the visitor will still see the email address as usual, it will be obfuscated or hidden from the email spambots and spider software.

= Does it mean that all email addresses on my website will be completely secure from spammers and they cannot harvest my emails? =

Well. Nobody can give full guarantee. As we find newer methods of obfuscating email addresses, so do the spammers to break such methods. No lock has ever been built that can safeguard your house from all the thieves and for ever. Even Microsoft Windows is pirated on the very day of its launch. What this plugin does is to make it extremely difficult for the spammers to automatically harvest email addresses from the website using spambots. We are working on more methods and this plugin will keep evolving newer methods of obfuscation. As of the date of this writing, our tests have found that email addresses secured by this plugin are completely safe and hidden from all the spambot or spider software that we experimented with. You can yourself see the results by experimenting with the plugin. Also see one of the screenshots in the Screenshots section wherein results of a famous email extractor not being able to find the email addresses obfuscated by this plugin are shown.

At this juncture, we may also point out that if you use the additional (optional) measure to further obfuscate the email addresses by replacing the @ and . (DOT) symbols in email addresses by something like ' (AT) ' and ' (DOT) ' respectively or some other similar custom (unique) text to be chosen by you, then the privacy of your email addresses from spambots will be almost fully protected. 

Please also keep in mind that a determined spammer can even manually visit your website and note down the email addresses manually by hand in order to spam you. So, would you completely stop displaying email addresses on your website? What this plugin does is to secure the email addresses from spammers using automated methods by making use of some innovative and effective techniques. We are willing to evolve further tricks. Your feedback and suggestions are welcome.

= How can I ask a support question or get help from you in case of any issue with TG Email Protection Plugin? =

If you have any doubt or support questions, you are welcome to leave your comments at the [TG Email Protection plugin](http://www.tekgazet.com/tg-email-protection-plugin) page. You can also ask your support questions on [WordPress plugin site](https://wordpress.org/plugins/tg-email-protection/).

== Screenshots ==

1. TG Email Protection plugin settings interface (Settings -> TG Email Protection). 
2. How to access TG Email Protection plugin settings interface from admin screen of your WordPress website.
3. See in action, how email addresses obfuscated by TG Email Protection plugin are not detected by a famous Email Extractor extension / software in Chrome browser. 

== Changelog ==

= 1.0 =
* This is the first fully-tested stable version of the plugin.

== Upgrade Notice ==

n.a.
