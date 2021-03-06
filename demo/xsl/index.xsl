<?xml version="1.0" ?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:param name="LANGUAGE" select="'en'" />
	<xsl:param name="STRINGS" select="document('../locale/locale.xml')" />
	<xsl:include href="includes.xsl" />

    <xsl:output 
		method="html" 
		indent="yes"
		doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
		doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" />
		
	<xsl:template match="/">
	<html>
		<xsl:variable name="title" select="'Demo application'" />
		<xsl:call-template name="head">
			<xsl:with-param name="title" select="$title" />
		</xsl:call-template>

		<body>
			<xsl:call-template name="menu" />

			<h1><xsl:value-of select="$title" /></h1>
			<p>This miniature application demoes various features of oz-php and oz-xsl. Please use the navigation above to access 
			various website parts.
			</p>
			
		</body>
	</html>
	</xsl:template>
</xsl:stylesheet>
