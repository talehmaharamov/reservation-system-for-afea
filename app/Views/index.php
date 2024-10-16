<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afea Group :)</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
<div id="root">
    <div class="app-layout-classic flex flex-auto flex-col">
        <div class="flex flex-auto min-w-0">
            <div class="flex flex-col flex-auto min-h-screen min-w-0 relative w-full">
                <div class="h-full flex flex-auto flex-col justify-between">
                    <main class="h-full">
                        <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
                            <div class="container mx-auto">
                                <?php if (session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <div class="alert-content">
                                                <span class="alert-icon">
                                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                         viewBox="0 0 20 20" aria-hidden="true" height="1em" width="1em"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                              clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            <div>
                                                <?php echo session()->getFlashdata('error'); ?>
                                            </div>
                                        </div>
                                    </div>

                                <?php endif; ?>
                                <?php if (session()->getFlashdata('success')): ?>
                                    <div class="alert alert-success">
                                        <div class="alert-content">
                                            <span class="alert-icon">
                                                <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                     viewBox="0 0 20 20" aria-hidden="true" height="1em" width="1em"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                            <div>
                                                <?php echo session()->getFlashdata('success'); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <h3 class="mb-4">Reservation system</h3>
                                <form action="/reservations/store" method="POST">
                                    <div class="form-container vertical">
                                        <div class="grid grid-cols-1 gap-4">
                                            <div>
                                                <div class="card adaptable-card !border-b pb-6 py-4 rounded-br-none rounded-bl-none">
                                                    <div class="card-body">
                                                        <h3 class="mb-6">Available seats:
                                                            <span id="available-seats" class="text-green-600">
                                                                <?php echo $availableSeats; ?>
                                                            </span>
                                                        </h3>
                                                        <div class="form-item vertical">
                                                            <label class="form-label mb-2">Event name</label>
                                                            <?php if (empty($events)): ?>
                                                                <p>No events available for reservation at this time.</p>
                                                            <?php else: ?>
                                                                <select class="input" name="event_id" id="event-select"  onchange="updateAvailableSeats()">
                                                                    <?php foreach ($events as $event): ?>
                                                                        <option value="<?php echo $event['id']; ?>"><?php echo $event['name']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="form-item vertical">
                                                            <label class="form-label mb-2">Your Name</label>
                                                            <input class="input" type="text" name="name"
                                                                   autocomplete="off" placeholder="Your Name" required>
                                                        </div>
                                                        <div class="flex justify-end">
                                                            <button type="submit" class="btn btn-solid">Reserve</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- Section to display reservation data for all events -->
                                <div class="card adaptable-card mt-4">
                                    <div class="card-body">
                                        <h4 class="mb-4">All Reservations:</h4>
                                        <table id="reservations-table" class="table-default table-hover">
                                            <thead>
                                            <tr>
                                                <th>Event Name</th>
                                                <th>Reserved Name</th>
                                                <th>Seat Number</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (!empty($events)): ?>
                                                <?php foreach ($events as $event): ?>
                                                    <?php foreach ($event['reservations'] as $reservation): ?>
                                                        <tr>
                                                            <td><?php echo $event['name']; ?></td>
                                                            <td><?php echo $reservation['name']; ?></td>
                                                            <td><?php echo $reservation['seat_number']; ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="3">No reservations available.</td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div id="error-message" class="text-red-500 mt-4"></div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/js/vendors.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/app.min.js'); ?>"></script>
<script>
    function updateAvailableSeats() {
        const eventId = document.getElementById('event-select').value;
        //Fetch ile secilen eventin neçə denə boş yeri qaldığını göstərirəm
        fetch(`/reservations/getAvailableSeats/${eventId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('available-seats').innerText = data.availableSeats;
            })
            .catch(error => {
                console.error('Error fetching available seats:', error);
                document.getElementById('available-seats').innerText = 'Error fetching data';
            });
    }
</script>
</body>
</html>
