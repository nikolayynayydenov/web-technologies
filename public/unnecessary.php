<?php foreach ($data['events'] as $event) :  ?>
    <li class="event">
        <h3><a href="/event/<?= $event->id ?>" class="link"><?= $event->name ?></a></h3>
        <?= $event->date . ', ' . $event->start . ' - ' . $event->end ?>
        <button class="showStudents" data-show="">Покажи студенти</button>

            <div class="hidden_students"></br>
            </br>
            <!-- <h4>Списък със студенти, които са участвали</h4> -->
            <?php if (count($event->attendances) === 0) : ?>
                За това събития няма записани присъствия
            <?php endif; ?>
             <ul>
                <?php foreach ($event->attendances as $attendance) : ?>
                    <li>
                        <a href="/attendance?fn=<?= $attendance->faculty_number ?>" class="link">
                            <?= $attendance->faculty_number ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </li>
<?php endforeach; ?>