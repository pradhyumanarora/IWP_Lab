<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html>
      <head>
        <title>Employee Information System</title>
        <style>
          body {
        background-color: #f2f2f2;
      }
      h2 {
        color: #333;
        text-align: center;
      }
      table {
        border-collapse: collapse;
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.4);
      }
      th, td {
        text-align: left;
        padding: 8px;
      }
      th {
        background-color: #0074D9;
        color: #fff;
      }
      tr:nth-child(even) {
        background-color: #f2f2f2;
      }
        </style>
      </head>
      <body>
        <h2>Employee Information System</h2>
        <table border="1">
          <tr bgcolor="#9acd32">
            <th>Employee Number</th>
            <th>Name</th>
            <th>Salary</th>
          </tr>
          <xsl:for-each select="employees/employee[salary > 100000]">
            <tr>
              <td><xsl:value-of select="emp_no"/></td>
              <td><xsl:value-of select="name"/></td>
              <td><xsl:value-of select="salary"/></td>
            </tr>
          </xsl:for-each>
        </table>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>