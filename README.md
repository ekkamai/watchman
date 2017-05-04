# Watchman

Google Chrome alerts users with a bright red warning if the site they're trying to visit is flagged as "dangerous or deceptive". For affiliates, this kills profit and effectively shuts down landing pages for Chrome users

_Once your domain is flagged, you need to act fast to switch out the domain name._

This simple script checks if a domain has been flagged by the Google Safe Browsing API and sends an email or text alert notifying you of the issue.

https://developers.google.com/safe-browsing/v4/get-started

The check will return "CLEAN" if no reports are found, "SOCIAL_ENGINEERING" or "MALWARE" if flagged.

### Step 1 - Good API Key

### Step 2 - Uptime Robot
This free service is typically used to check for downtime, but we'll be using it to schedule checks automatically and alert us of issues

*1 - Register for an account*
https://uptimerobot.com/signUp

*2 - Add Alert*

Monitor Type: Keyword
Friendly Name: Anything
URL (or IP): http://example.com/check.php/check.php?url=checkdomain.com
Keyword: CLEAN
Alert When: Keyword Not Exists
Monitoring Interval: 15 Mins

http://example.com/check.php/check.php?url=checkdomain.com

![uptime robot screenshot](http://i.imgur.com/LoF2qpF.png)
