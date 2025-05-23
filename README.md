# NATÚRBLOG ENGINE

A primitive but fast and useful PHP Native and Markdown based blog engine.
This is a personal development using procedural PHP. 
Naked blogging platform, for minimalists. _Just write!_

## PHILOSOPHY

Blogging is beautiful. It's about sharing opinions on the web about anything, with one's own idea of aesthetics, however weird it is—or rather, especially because of how weird it is.
We recommend that one does not look into Analytics. It's mostly fuel for ego.

## FEATURES

* No ads, zero tracking (no cookies for analytics or tracking)
* 100% open source and FREE!
* No DB => No SQL => NO SQL Injection
* Fast: PHP native code, just a few HTTP request number
* No login, no account 
* No administration interface
* Simple Markdown format posts
  - Check Demo posts
  - Check [Markdown Cheat Sheet](https://www.markdownguide.org/cheat-sheet/)
  - Use [Markdown Preview](https://markdownlivepreview.com/)
* Quick installation
* Multi-language user interface
  - for now only English, German and Hungarian
* Listing, separating (pagination) and filtering (by tags) posts
* Pager (previous and next post) [NEW FEATURE!]
* RSS, Sitemap
* Tags, Tag Cloud
* Changing articles font size
* Light mode / Dark mode
* Responsive (mobile and tablet friendly) front-end
* Google Chrome Lighthouse Performance Test: 100%
* Printer friendly web pages
* Calculating posts reading time
* Show posts' creation time and author's nickname
* Copying and/or Sharing page URL
* Adult content alert
* Multiple post types (what the Markdown format can handle):
  - text/story, article
  - image/photo/picture
  - link/URL
  - quotes
  - video (recommended: Youtube embedding)
  - music (recommended: Soundcloud embedding)
  - code sharing
* Debug mode for developers
* Optionally third party comment system (commento.io) 

## REQUIREMENTS

* PHP 5+
* Apache Web server (and virtual host for testing)

## DIRECTORY STRUCTURE

~~~
* system/         contains base functions
* languages/      contains files for multilanguage UI
* model/          contains model functions (for Markdown)
* controller/     contains Web controller functions
* views/          contains view files for the Web application and resources
* download/       contains downloadable files
* help/           contains help files
~~~

## GETTING STARTED / INSTALLATION

These instructions will get you a copy of the project up and running on your local machine (by virtual hosting) for development and testing purposes. 

Instructions to follow:

1. Copy all files to webserver
2. Edit the file `system/config.php` with real data \*
3. Edit `robots.txt` and `.htaccess` files with real data \*\*
4. Run your server and navigate to the project: https://yourdomain.com/

\* Edit the blog name - and replace logo.svg, favicon.ico and apple-touch-icon.png files.

\*\* Modify the redirect rules of your domain in the .htaccess file, and edit your Sitemap path in the robots.txt 

## LIVE DEMO

English Version: https://naturblog.csa.hu/

## MARKDOWN / POST CONTENT FILES

Make a new or edit an existing *.md file (in `model/posts/` folder) for blog posts

## BUILT WITH

* [AppServ](https://www.appserv.org/) - Simple package for programming (Apache + PHP + MySQL)
* [PSPad](https://www.pspad.com/) - Code editor

## SCREENSHOTS

### Filtered Post by a Tag, Dark Mode, without Pagination, and Adult Content Alert.  

![Filtered posts](https://raw.githubusercontent.com/webdevCsAB/naturblog/main/help/nb-help-filtered-posts.PNG)

### Light Mode

![Light Mode](https://raw.githubusercontent.com/webdevCsAB/naturblog/main/help/nb-help-light-mode.PNG)

### Dark Mode

![Dark Mode](https://raw.githubusercontent.com/webdevCsAB/naturblog/main/help/nb-help-dark-mode.PNG)

### Footer navigation and Go to the Top button

![Go to the Top](https://raw.githubusercontent.com/webdevCsAB/naturblog/main/help/nb-footer-go-to-the-top.PNG)

### Font size, Light/Dark mode and RSS button

![User friendly design](https://raw.githubusercontent.com/webdevCsAB/naturblog/main/help/nb-help-large-font-size.PNG)

### Pagination First Page

![Pagination First Page](https://raw.githubusercontent.com/webdevCsAB/naturblog/main/help/nb-help-paginator-dont-stop-now.PNG)

### Pagination Last Page

![Pagination First Page](https://raw.githubusercontent.com/webdevCsAB/naturblog/main/help/nb-help-paginator-last-page.PNG)

### Google Chrome Lighthouse Performance Test: 100%

![Google Chrome Lighthouse Performance Test](https://raw.githubusercontent.com/webdevCsAB/naturblog/main/help/lighthouse-performance-test-home-page-desktop.PNG)

### Amount of carbon emits per page load: 1.71 mg CO<sub>2</sub>

![Amount of carbon emits per page load](https://raw.githubusercontent.com/webdevCsAB/naturblog/main/help/amount-of-carbon-emits-per-page-load.PNG)

## LICENSE

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details