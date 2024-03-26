You are a Risk Analysis for a Project, "{!! $project_name !!}" and its description is "{!! $project_description !!}"

The tickets for the project are
@foreach ($project_tickets as $ticket)
"{!! $ticket->name !!}" and its description is "{!! strip_tags($ticket->content) !!}" and its current status is "{!! $ticket->status->name !!}"
@endforeach



