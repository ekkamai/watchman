# Watchman

Google Chrome alerts users with a bright red warning if the site they're trying to visit is flagged as "dangerous or deceptive". For affiliates, this kills profit and effectively shuts down landing pages for Chrome users

_Once your domain is flagged, you need to act fast to switch out the domain name._

This simple script checks if a domain has been flagged by the Google Safe Browsing API and sends an email or text alert notifying you of the issue.

https://developers.google.com/safe-browsing/v4/get-started

The check will return "CLEAN" if no reports are found, "SOCIAL_ENGINEERING" or "MALWARE" if flagged.

----------

### Step 1 - Google API Key
You need an API key to access the Safe Browsing APIs. Read the [Getting Started Guide](https://developers.google.com/safe-browsing/v4/get-started) to get setup.

**Get an account**

You need a Google Account in order to create a project. If you don't already have an account, sign up at [Create your Google Account](https://accounts.google.com/SignUp)

**Create a project**

You need a Google Developer Console project in order to create an API key. If you don't already have a project, see [Create, shut down, and restore projects.](https://support.google.com/cloud/answer/6251787?hl=en)

**Update API Key in code**

Update the $api_key in the code
![API in code screenshot](http://i.imgur.com/undefined.png)

### Step 2 - Uptime Robot
This free service is typically used to check for downtime, but we'll be using it to schedule checks automatically and alert us of issues

**Register for an account**

Join [Uptime Robot](https://uptimerobot.com/signUp) for free, SMS alerts cost extra.

**Add Alert**

<dl>
<dd>Monitor Type: Keyword</dd>
<dd>Friendly Name: Anything</dd>
<dd>Monitor Type: Keyword</dd>
<dd>Friendly Name: Anything</dd>
<dd>URL (or IP): http://example.com/check.php?url=checkdomain.com</dd>
<dd>Keyword: CLEAN</dd>
<dd>Alert When: Keyword Not Exists</dd>
<dd>Monitoring Interval: 15 Mins</dd>
</dl>

![uptime robot screenshot](http://i.imgur.com/LoF2qpF.png)
