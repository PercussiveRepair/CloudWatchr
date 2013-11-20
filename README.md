CWGraphs
========

AWS Cloudwatch automated ELB/RDS/EC2 graphing

Using
* AWS PHP-SDK v1.62 - https://github.com/amazonwebservices/aws-sdk-for-php
* Flot - https://github.com/flot/flot

Builds upon but is substantially changed from https://github.com/manuskc/aws-cloudchart

Plots all the Cloudwatch metrics for your ELB, EC2 and RDS instances using only a set of read-only IAM credentials


How to use
----------

Requires: 
* Nginx, Apache or similar web server
* A set of Amazon IAM credentials (use the Read-only Access policy template provided by AWS)
 
This uses the outdated but still functional AWS PHP-SDK v1.62 to enumerate, and then gather Cloudwatch data for the last 6 hours for, any ELB, EC2 and RDS instances running in the account to which your IAM credentials give access.

The code is pre-configured for all the major (and some minor) Cloudwatch metrics for each instance type. 

The code should be pretty easy to read and add to. Please feel free to contribute and/or fork. 

Released under the MIT licence.



PS. Apologies for my code. I'm a sysadmin, not a programmer :)
