<?php
require("./scoober-api/index.php");
require './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
// use DateInterval;
// use DateTimeImmutable;
use Eluceo\iCal\Domain\Entity\Calendar;
use Eluceo\iCal\Domain\Entity\Event;
use Eluceo\iCal\Domain\ValueObject\Alarm;
use Eluceo\iCal\Domain\ValueObject\Attachment;
use Eluceo\iCal\Domain\ValueObject\DateTime;
use Eluceo\iCal\Domain\ValueObject\EmailAddress;
use Eluceo\iCal\Domain\ValueObject\GeographicPosition;
use Eluceo\iCal\Domain\ValueObject\Location;
use Eluceo\iCal\Domain\ValueObject\Organizer;
use Eluceo\iCal\Domain\ValueObject\TimeSpan;
use Eluceo\iCal\Domain\ValueObject\Uri;
use Eluceo\iCal\Presentation\Factory\CalendarFactory;
use Generator;

$api = new scoober_api($_ENV["username"], $_ENV["password"]);
$data = json_decode($api->get_schedule(), true);
var_dump($data);

$calendar = new Calendar();

foreach ($data as $key => $value) {
    $from = substr($value["fromUnixOffset"], 0, -3);
    $to = substr($value["toUnixOffset"], 0, -3);

    $event = (new Eluceo\iCal\Domain\Entity\Event())
        ->setSummary("werken thuisbezorgd")
        ->setDescription("ingeplanned door: {$value["createdBy"]}")
        ->setOccurrence(new TimeSpan(
            new DateTime(DateTimeImmutable::createFromFormat('U', $from), false),
            new DateTime(DateTimeImmutable::createFromFormat('U', $to), false)
        ));
    $calendar->addCoamponent($event);
};

// 2. Create Calendar domain entity
// $calendar = new Calendar([$event]);

// 3. Transform domain entity into an iCalendar component
$componentFactory = new CalendarFactory();
$calendarComponent = $componentFactory->createCalendar($calendar);


file_put_contents('calendar.ics', (string) $calendarComponent);
// // 4. Set 
// header('Content-Type: text/calendar; charset=utf-8');
// header('Content-Disposition: attachment; filename="cal.ics"');

// // 5. Output
// echo $calendarComponent;
