<?php
namespace Cvanh;
// use Cvanh;   
use Eluceo\iCal\Domain\Entity\Calendar;
use Eluceo\iCal\Domain\Entity\Event;
use Eluceo\iCal\Domain\ValueObject\DateTime;
use Eluceo\iCal\Domain\ValueObject\TimeSpan;
use Eluceo\iCal\Presentation\Factory\CalendarFactory;
use DateTimeImmutable;

class Planning 
{
    function getavailability($uid)
    {
        $api = new Scoober($uid);
        $data = json_decode($api->get_schedule("2000-01-24", "2032-01-30"), true);

        $shifts = [];

        foreach ($data as $key => $value) {
            // formats the time to Eluceo\iCal specifacations and sets it to the correct timezone(gmt + 1)
            $from = substr($value["fromUnixOffset"], 0, -3) + 3600;
            $to = substr($value["toUnixOffset"], 0, -3) + 3600;

            // create a event
            $event = (new Event())
                ->setSummary("werken thuisbezorgd")
                ->setDescription("ingeplanned door: {$value["createdBy"]}")
                ->setOccurrence(new TimeSpan(
                    new DateTime(DateTimeImmutable::createFromFormat('U', $from), false),
                    new DateTime(DateTimeImmutable::createFromFormat('U', $to), false)
                ));
            // sets all event to an array with all the events
            $shifts[] = $event;
        }

        // create Calendar domain entity
        $calendar = new Calendar($shifts);

        // Transform domain entity into an iCalendar component
        $componentFactory = new CalendarFactory();
        $calendarComponent = $componentFactory->createCalendar($calendar);


        // file_put_contents('calendar.ics', (string) $calendarComponent);

        // 4. save 
        // header('Content-Type: text/calendar; charset=utf-8');
        // header('Content-Disposition: attachment; filename="cal.ics"');

        // // 5. Output
        return $calendarComponent;
    }
}
