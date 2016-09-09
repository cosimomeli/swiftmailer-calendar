# swiftmailer-calendar
A simple class to embed calendar events to emails.

## Installation

You can install this package by using [Composer](http://getcomposer.org), running this command:

```sh
composer require cosimomeli/swiftmailer-calendar
```
Link to Packagist: https://packagist.org/packages/cosimomeli/swiftmailer-calendar

## Usage

### Basic Usage

#### 1. Create an iCal object

You can make it by string concatenation or you can use one of the many libraries to build it.
I suggest markuspoerschke/iCal: https://github.com/markuspoerschke/iCal

The result will be something like this:

```
BEGIN:VCALENDAR
VERSION:2.0
PRODID:TestCalendar
METHOD:REQUEST
X-PUBLISHED-TTL:P1W
BEGIN:VEVENT
UID:57d2e0b599f89
DTSTART:20170320T110000Z
SEQUENCE:0
TRANSP:OPAQUE
DTEND:20170320T150000Z
LOCATION:900 Jay St.\, Brooklyn
SUMMARY:Summary of the event
ATTENDEE;PARTSTAT=ACCEPTED;RSVP=FALSE:mailto:example@domain.com
CLASS:PUBLIC
DESCRIPTION:Description of the event
ORGANIZER:mailto:organizer@example.com
DTSTAMP:20160909T161757Z
END:VEVENT
END:VCALENDAR
```

More information about iCalendar specifications here: http://www.kanzaki.com/docs/ical/

Just be sure to set the METHOD field as PUBLISH or REQUEST, and set at least the recipient of the email as ATTENDEE.
 
 #### 2. Create the Swift_Calendar object
 
 ```PHP
 $attachment = new Swift_Calendar($iCalString, Swift_Calendar::METHOD_REQUEST);
 ```
 
 The method must be the same as the one you set in the iCal.
 
 ### 3. Attach it to the message
 
 ```PHP
 $swiftMessage->attach($attachment);
 ```
 
 You can add more different MIME parts to the message. I tested it with text/plan + text/html and with a normal attachment too.
 
 ### 4. Send it
 
 ```PHP
 $mailer->send($swiftMessage);
 ```
 
 ##Notes
 
 Mail clients handle the embedded calendar in different ways.
 Here are some of my personal experiences:
 
 * **Outlook**: Uses the email body as event description and the email subject as event title. Calendars with PUBLISH method are not listed with emails, but only showed as toast in the web interface (so my advice is to NOT use this method).
 
 * **Gmail**: Uses the fields DESCRIPTION and SUMMARY as description and title of the event (just as it should be)
  
  ##
  
  Feel free to ask any question and to give any suggestion for improvements.  