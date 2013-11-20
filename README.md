CWGraphs
========

AWS Cloudwatch automated ELB/RDS/EC2 graphing

Using
* AWS PHP-SDK v1.62 - https://github.com/amazonwebservices/aws-sdk-for-php
* Flot - https://github.com/flot/flot
* Twitter Bootstrap v2.3.2 - https://github.com/twbs/bootstrap

Builds upon but is substantially changed from https://github.com/manuskc/aws-cloudchart

Plots all the Cloudwatch metrics for your ELB, EC2 and RDS instances using only a set of read-only IAM credentials

About
------
This uses the outdated but still functional AWS PHP-SDK v1.62 to enumerate, and then gather Cloudwatch data for the last 6 hours for, any ELB, EC2 and RDS instances running in the account to which your IAM credentials give access.

The code is pre-configured for all the major (and some minor) Cloudwatch metrics for each instance type. 

It also has two cool features:
* Clicking an entry in the legend will hide that data series on that graph and all below it. Clicking it again with unhide.
* Data series are automatically coloured. Makes reading the graphs a bit more pleasant. 

The code should be pretty easy to read and add to. Please feel free to contribute and/or fork. 

Released under the MIT licence.

How to use
----------

Requires: 
* Nginx, Apache or similar web server
* A set of Amazon IAM credentials (use the Read-only Access policy template provided by AWS)

Clone the repo/Upload to a web accessible folder on your server.

Edit AWS-sdk/config.inc.php to include your own IAM key and secret.

You may also need to grep for REGION_EU_W1 and change it to your applicable AWS region namespace. See here: http://docs.aws.amazon.com/AWSSDKforPHP/latest/index.html#m=AmazonEC2/set_region

Done! Your graphs should now be viewable.

PS. Apologies for my code. I'm a sysadmin, not a programmer :)
