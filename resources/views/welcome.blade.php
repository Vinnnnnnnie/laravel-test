<x-layout>
    <div >
        <section class='bg-gray-800 p-8 my-4'>
            <h2>Vincent Owens - Software Developer</h2>
            <h3>PROFILE</h3>
            <p>
                Experienced database administrator with a background in public facing applications 
                looking for opportunities in website and app development. 
                Professionally maintained 4 high-quality public websites and a 90 million 
                record database for 3 years, proficient with php and MVC practices, proven love 
                of programming and technology.
            </p>
        </section>
        <section class='bg-gray-800 p-8 my-4'>
            <h3>PROFESSIONAL EXPERIENCE</h3>
            <div>
                <h4>Software Engineer	C-Tec Research and Development 	September 2022 - Present</h4>
                <ul class='list-disc'>
                    <li>
                        Designed, developed and maintained a secure database web portal for easier modification of database by select authorised users.
                    </li>
                    <li>
                        Created an updating server dashboard that displays the status of all internal services, database connections, reads, writes, updates, server storage and memory across 6 servers.
                    </li>
                    <li>
                        Optimised a live database to reduce data fetch times and reduce storage concerns before data became unmanageable.
                    </li>
                    <li>
                        Implemented requested features in an agile environment with a group of developers, utilising REST APIs.
                    </li>
                    <li>
                        Integrated server cron jobs to manage storage and for regular maintenance tasks.
                    </li>
                    <li>
                        Communicated with customers to diagnose and resolve product issues.
                    </li>
                </ul>
                <h4>Data Entry	Preworn LTD	December 2021 - June 2022</h4>
                <ul class='list-disc'>
                    <li>
                        Inspected items for quality and logged merchandise defects.
                    </li>
                    <li>
                        Consistently performed at 140% of daily and weekly entry targets.
                    </li>
                    <li>
                        Assisted colleagues with hardware and software troubleshooting.
                    </li>
                </ul>
            </div>
        </section>
        <section class='bg-gray-800 p-8 my-4 flex flex-col'>
            <h3>Skills</h3>
            <h4 class="self-center">Languages</h4>
            <div class="flex flex-row items-center justify-between gap-4">
                <div class="rounded rounded-l">
                    <img width="150px" height="100%" src="{{ route('image.website', 'MySQL.png') }}"\>
                </div>
                <div class="rounded-l">
                    <img width="150px" height="100%" src="{{ route('image.website', 'Php.png') }}"\>
                </div>
                <div class="rounded-l">
                    <img width="150px" height="100%" src="{{ route('image.website', 'JavaScript.png') }}"\>
                </div>
                <div class="rounded-l">
                    <img width="150px" height="100%" src="{{ route('image.website', 'Bash Dark.png') }}"\>
                </div>
                <div class="rounded-l">
                    <img width="150px" height="100%" src="{{ route('image.website', 'Godot Dark.png') }}"\>
                </div>
            </div>
            <h4 class="self-center">Frameworks</h4>

            <div class="flex flex-row items-center justify-between gap-4">
                <div>
                    <img width="150px" height="100%" src="{{ route('image.website', 'Laravel.png') }}"\>
                </div>
                <div>
                    <img width="150px" height="100%" src="{{ route('image.website', 'Git Dark.png') }}"\>
                </div>
                <div>
                    <img width="150px" height="100%" src="{{ route('image.website', 'Docker.png') }}"\>
                </div>
                <div>
                    <img width="150px" height="100%" src="{{ route('image.website', 'Tailwind.png') }}"\>
                </div>
                <div>
                    <img width="150px" height="100%" src="{{ route('image.website', 'Linux.png') }}"\>
                </div>
            </div>
        </section>
        <section class='bg-gray-800 p-8 my-4'>
            <h3>PROJECTS</h3>
            <div class="flex flex-row gap-6">
                <div>
                    <a href="https://ldjam.com/events/ludum-dare/58/the-garbage-man-of-new-trash-city" target="_blank">
                        <h4>Ludum Dare 58 Entry</h4>
                        <img src="{{ route('image.website', 'The Garbage Man of New Trash City Title.jpeg') }}"/>
                    </a>
                    <h5>The Garbage Man of New Trash City</h5>
                    <p>
                        Inspired by early flash games and crazy taxi, we developed a game in 3 days where collecting rubbish from 
                        the streets and depositing it adds extra time to play. This is coupled with having to take calls from your 
                        boss with Helldivers inspired keyboard combinations. The game is hectic and provides a fun gameplay loop.
                    </p>
                    <ul class='list-disc'>
                        <li>
                            Developed as a team of 2 programmers and 5 artists/sound designers using Godot 4 for development and Git for version control with a strict time limit of 72 hours.
                        </li>
                        <li>
                            Communicated across the whole team to follow the group vision whilst efficiently managing time for the required features.
                        </li>
                        <li>
                            Published both games with original gameplay loop, voxel/pixel art and sound effects.
                        </li>
                    </ul>
                </div>
                <div>
                    <a href="/recipes" target="_blank">
                        <h4>Laravel Website</h4>
                        <img src="{{ route('image.website', 'The Garbage Man of New Trash City Title.jpeg') }}"/>
                    </a>
                    <h5>Recipe Social Media Site</h5>
                    <p>
                        Inspired by early flash games and crazy taxi, we developed a game in 3 days where collecting rubbish from 
                        the streets and depositing it adds extra time to play. This is coupled with having to take calls from your 
                        boss with Helldivers inspired keyboard combinations. The game is hectic and provides a fun gameplay loop.
                    </p>
                    <ul class='list-disc'>
                        <li>
                            Solo project of a recipe social media site using Laravel.
                        </li>
                        <li>
                            Applied existing understanding of database relationships with inbuilt MVC systems.
                        </li>
                        <li>
                            Utilised testing features like factories to debug eloquent models.
                        </li>
                    </ul>
                </div>
            </div>
            
            <h4>Game Developer	Ludum Dare Game Jam (2 Entries)	April 2025 - Present</h4>
            
            
        </section>
        <section class='bg-gray-800 p-8 my-4'>
            <h3>EDUCATION</h3>
            <p><strong>Diploma of Higher Education (Mathematics):</strong> Lancaster University	2018 - 2021</p>
        </section>
        <section class='bg-gray-800 p-8 my-4'>
            <h3>OTHER INTERESTS</h3>
            <p>Avid motorcyclist and amateur mechanic. Currently fixing up a non-running 1994 BMW motorcycle.</p>
            <p>Hobbyist mead brewer, cooking enthusiast and novice handyman.</p>
        </section>
    </div>
</x-layout>