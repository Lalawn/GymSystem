import './bootstrap';
import Calendar, { TZDate } from '@toast-ui/calendar'

    document.addEventListener('DOMContentLoaded', function () {
        var cal = new Calendar(document.querySelector('#calendar'), {
            defaultView: 'month',
            useCreationPopup: true,
            useDetailPopup: true,
        });


        fetch('/api/events')
            .then(response => response.json())
            .then(events => {
                events.forEach(event => {
                    cal.createEvents([{
                        id: event.id,
                        calendarId: '1',
                        title: event.title,
                        category: 'time',
                        start: event.start,
                        end: event.end
                    },
                        {

                            id: 'event1',
                            calendarId: 'cal2',
                            title: 'Weekly meeting',
                            start: '2024-11-07T09:00:00',
                            end: '2024-11-07T10:00:00',
                        }]);
                });
            })
            .catch(error => console.error('Error loading events:', error));
    });

