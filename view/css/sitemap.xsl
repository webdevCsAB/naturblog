<xsl:stylesheet version="2.0" xmlns:html="http://www.w3.org/TR/REC-html40" xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html" version="1.0" encoding="utf-8" indent="yes"/>
  <!-- Root template -->
  <xsl:template match="/">
    <html>
      <head>
        <title>Sitemap file</title>
        <script type="text/javascript" src="/view/js/jquery.min.js"/>
        <script type="text/javascript" src="/view/js/jquery.tablesorter.min.js"/>
        <script type="text/javascript" src="/view/js/xmlsitemap.xsl.js"/>
        <link href="/view/css/xmlsitemap.xsl.css" type="text/css" rel="stylesheet"/>
      </head>

      <!-- Store in $fileType if we are in a sitemap or in a siteindex -->
      <xsl:variable name="fileType">
        <xsl:choose>
          <xsl:when test="//sitemap:url">sitemap</xsl:when>
          <xsl:otherwise>siteindex</xsl:otherwise>
        </xsl:choose>
      </xsl:variable>

      <body>
        <h1>Sitemap file</h1>
        <xsl:choose>
          <xsl:when test="$fileType='sitemap'"><xsl:call-template name="sitemapTable"/></xsl:when>
          <xsl:otherwise><xsl:call-template name="siteindexTable"/></xsl:otherwise>
        </xsl:choose>

        <div id="footer">
          <p>Powered by <a href="/">NatúrBlog Engine</a> (CsAB). All rights reserved.</p>
        </div>
      </body>
    </html>
  </xsl:template>

  <!-- siteindexTable template -->
  <xsl:template name="siteindexTable">
    <div id="information">
      <p>Number of sitemaps in this index: <xsl:value-of select="count(sitemap:sitemapindex/sitemap:sitemap)"/></p>
    </div>
    <table class="tablesorter siteindex">
      <thead>
        <tr>
          <th>Sitemap URL</th>
          <th>Last modification date</th>
        </tr>
      </thead>
      <tbody>
        <xsl:apply-templates select="sitemap:sitemapindex/sitemap:sitemap">
          <xsl:sort select="sitemap:lastmod" order="descending"/>
        </xsl:apply-templates>
      </tbody>
    </table>
  </xsl:template>

  <!-- sitemapTable template -->
  <xsl:template name="sitemapTable">
    <div id="information">
      <p>Number of URLs in this sitemap: <xsl:value-of select="count(sitemap:urlset/sitemap:url)"/></p>
    </div>
    <table class="tablesorter sitemap">
      <thead>
        <tr>
          <th>URL location</th>
          <th>Last modification date</th>
          <th>Change frequency</th>
          <th>Priority</th>
        </tr>
      </thead>
      <tbody>
        <xsl:apply-templates select="sitemap:urlset/sitemap:url">
          <xsl:sort select="sitemap:priority" order="descending"/>
        </xsl:apply-templates>
      </tbody>
    </table>
  </xsl:template>

  <!-- sitemap:url template -->
  <xsl:template match="sitemap:url">
    <tr>
      <td>
        <xsl:variable name="sitemapURL"><xsl:value-of select="sitemap:loc"/></xsl:variable>
        <a href="{$sitemapURL}" ref="nofollow"><xsl:value-of select="$sitemapURL"/></a>
      </td>
      <td><xsl:value-of select="sitemap:lastmod"/></td>
      <td><xsl:value-of select="sitemap:changefreq"/></td>
      <td>
        <xsl:choose>
          <!-- If priority is not defined, show the default value of 0.5 -->
          <xsl:when test="sitemap:priority">
            <xsl:value-of select="sitemap:priority"/>
          </xsl:when>
          <xsl:otherwise>0.5</xsl:otherwise>
        </xsl:choose>
      </td>
    </tr>
  </xsl:template>

  <!-- sitemap:sitemap template -->
  <xsl:template match="sitemap:sitemap">
    <tr>
      <td>
        <xsl:variable name="sitemapURL"><xsl:value-of select="sitemap:loc"/></xsl:variable>
        <a href="{$sitemapURL}"><xsl:value-of select="$sitemapURL"/></a>
      </td>
      <td><xsl:value-of select="sitemap:lastmod"/></td>
    </tr>
  </xsl:template>
</xsl:stylesheet>