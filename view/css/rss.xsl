<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:output method="html" version="1.0" encoding="utf-8" indent="yes" />
  <!-- Root template -->
  <xsl:template match="/">
    <html>
      <head>
        <title><xsl:value-of select="/rss/channel/title" /></title>
        <script type="text/javascript"><![CDATA[
            function HTMLDecode(s){
            s = s.replace(new RegExp(/&lt;/gi), "<");
            s = s.replace(new RegExp(/&gt;/gi), ">");
            s = s.replace(new RegExp(/&amp;/gi), "&");
            return s;
          }]]>
        </script>
        <style type="text/css">
            html, body { margin:0;padding:0;border:0; color:#3a4f66; font: normal 13px/1.5em Verdana,Tahoma,Arial,sans-serif; background:#FFFFFF; }
            body {padding:1em; }
            a, a:visited { text-decoration:none; color:#009966; }
            a:hover, a:active, a:focus { text-decoration:underline; color:#113355; }
            a:hover img, a:active img, a:focus img { transform: scale(1.05); }
            p { padding:0.5em 0; margin:0; }
            .channel-header{
               padding:0;
            }
            hr { background:transparent;color:transparent;border-bottom:1px dotted #777777;display:block;margin:1em 0;padding:0; height:0px; }
            img { border: none; }
            .channel-image { 
              float:right;
              padding:0;
              margin: 0 0 10px 10px;
            }
            .channel-title{
              font-size:20px;
              font-weight:bold;
              line-height:1.2em;
              padding:0 0 0.5em 0; margin:0;
              display:inline;
              color:#3a4f66;
            }
            .channel-desc {
              margin-top:-1em;
              color:#3a4f66;
            }
            .item h2 {
              display:block;
              padding:0.5em 0;
              margin:0;
              font-size:18px;
              font-weight:bold;
              line-height:1.2em;
            }
            .item-meta{
              color:#3a4f66;
              margin-top:-1em;
              display:block;
            }
            .item-content{
              margin:0;
              padding:0 1em 0.5em 1em;
            }
            .clr { clear:both; }
          </style>
      </head>
      <body>

          <div class="channel-header">

            <a href="{/rss/channel/link}">
            <img class="channel-image" src="{/rss/channel/image/url}" alt="{/rss/channel/title}" width="{/rss/channel/image/width}" height="{/rss/channel/image/height}" /></a>
           
            <h1><a href="{/rss/channel/link}" class="channel-title"><xsl:value-of select="/rss/channel/title" /></a></h1>
           
            <p class="channel-desc">
              <xsl:value-of select="/rss/channel/description" /> 
            </p>
     
          </div>

            <hr />


          <div class="item">
               <xsl:apply-templates select="/rss/channel/item" />
          </div>
          
          <br />
          
          <hr />        

          <p align="center">
            <xsl:value-of select="/rss/channel/copyright" /> 
          </p>
        
      </body>
    </html>
</xsl:template>

<!-- rssItem template -->
<xsl:template match="item">
   <div>
       <h2><a href="{link}"><xsl:value-of select="title" /></a></h2>
       <p class="item-meta"><small><xsl:value-of select="pubDate" /> | <xsl:value-of select="author" /></small></p>

       <div class="item-content">
         <xsl:attribute name="id">td<xsl:number level="any" /></xsl:attribute>
         <xsl:value-of select="description" />
        <script>td<xsl:number level="any" /><![CDATA[.innerHTML=HTMLDecode(]]>td<xsl:number level="any" /><![CDATA[.innerHTML);]]></script>
      </div>
   <div class="clr"></div>
   </div>
</xsl:template>

</xsl:stylesheet>