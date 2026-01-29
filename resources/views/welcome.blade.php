<x-layout>
    <div >
        <h2>Vincent Owens - Software Developer</h2>
        <h3>Profile</h3>
        <section class='bg-gray-900 border-1 border-gray-100 p-8 my-4'>
            <p>
                Experienced software engineer with a background in public facing applications 
                looking for opportunities in website and app development. 
                Professionally maintained 4 high-quality public websites and a 90 million 
                record database for 3 years, proficient with php and MVC practices, proven love 
                of programming and technology.
            </p>
        </section>
        <h3>Professional Experience</h3>
        <section class='bg-gray-900 border-1 border-gray-100 p-8 my-4'>
            <div>
                <div class='flex flex-row justify-between items-center mb-2'>
                    <h3>Software Engineer</h3>
                    <div class='flex flex-col items-end'>
                        <h4 class='text-gray-100 font-semibold'>C-Tec Research and Development</h4>
                        <h4 class='text-gray-300'>September 2022 - Present</h4>
                    </div>
                </div>
                <p class='text-gray-200'>
                    Built a live dashboard measuring current database statistics to monitor product uptake and database 
                    performance.
                    Developer of internal web tools to interact with and monitor Database, built in the LAMP stack. 
                    Maintained and added features for 3 public facing websites.
                </p>
                <ul class='list-disc ml-6 text-gray-300'>
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
                <div class='flex flex-row justify-between items-center mb-2'>
                    <h3>Data Entry</h3>
                    <div class='flex flex-col items-end'>
                        <h4 class='text-gray-100 font-semibold'>Preworn LTD</h4>
                        <h4 class='text-gray-300'>December 2021 - June 2022</h4>
                    </div>
                </div>
                <p class='text-gray-200'>
                    Built a live dashboard measuring current database statistics to monitor product uptake and database 
                    performance.
                    Developer of internal web tools to interact with and monitor Database, built in the LAMP stack. 
                    Maintained and added features for 3 public facing websites.
                </p>
                <ul class='list-disc text-gray-300'>
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
        <h3>Skills</h3>
        <section class='bg-gray-900 border-1 border-gray-100 p-8 my-4 flex flex-col'>
            <h3 class="self-center text-white">Languages</h4>
            <div class="flex flex-row items-center justify-between gap-4">
                <div class="rounded rounded-l">
                    <img class='transition ease-in-out hover:scale-110' width="150px" height="100%" src="{{ route('image.website', 'MySQL.png') }}"\>
                </div>
                <div class="rounded-l">
                    <img class='transition ease-in-out hover:scale-110' width="150px" height="100%" src="{{ route('image.website', 'Php.png') }}"\>
                </div>
                <div class="rounded-l">
                    <img class='transition ease-in-out hover:scale-110' width="150px" height="100%" src="{{ route('image.website', 'JavaScript.png') }}"\>
                </div>
                <div class="rounded-l">
                    <img class='transition ease-in-out hover:scale-110' width="150px" height="100%" src="{{ route('image.website', 'Bash Dark.png') }}"\>
                </div>
                <div class="rounded-l">
                    <img class='transition ease-in-out hover:scale-110' width="150px" height="100%" src="{{ route('image.website', 'Godot Dark.png') }}"\>
                </div>
            </div>
        </section>
        <section class='bg-gray-900 border-1 border-gray-100 p-8 my-4 flex flex-col'>
            <h3 class="self-center text-white">Frameworks and Others</h4>
            <div class="flex flex-row items-center justify-between gap-4">
                <div>
                    <img class='transition ease-in-out hover:scale-110' width="150px" height="100%" src="{{ route('image.website', 'Laravel.png') }}"\>
                </div>
                <div>
                    <img class='transition ease-in-out hover:scale-110' width="150px" height="100%" src="{{ route('image.website', 'Git Dark.png') }}"\>
                </div>
                <div>
                    <img class='transition ease-in-out hover:scale-110' width="150px" height="100%" src="{{ route('image.website', 'Docker.png') }}"\>
                </div>
                <div>
                    <img class='transition ease-in-out hover:scale-110' width="150px" height="100%" src="{{ route('image.website', 'Tailwind.png') }}"\>
                </div>
                <div>
                    <img class='transition ease-in-out hover:scale-110' width="150px" height="100%" src="{{ route('image.website', 'Linux.png') }}"\>
                </div>
            </div>
        </section>
        <h3>Projects</h3>
        <section>
            <div class="grid grid-cols-2 gap-10">
                <div class='group relative bg-gray-900 border-1 border-gray-100  p-4 my-4'>
                    
                    <div class='flex flex-row'>
                        <div>
                            <h2 class='text-orange-500 font-bold mt-2'>Ludum Dare 58</h2>
                            <a href="https://ldjam.com/events/ludum-dare/58/the-garbage-man-of-new-trash-city" target="_blank">
                                <h3 class='text-white-50'>The Garbage Man of New Trash City</h3>
                            </a>
                            <p class='text-gray-200 mb-2'>
                        Inspired by early flash games and crazy taxi, we developed a game in 3 days where collecting rubbish from 
                        the streets and depositing it adds extra time to play. 
                    </p>
                    <p class='text-gray-200 mb-2'>
                        This is coupled with having to take calls from your boss with Helldivers inspired keyboard combinations.
                        The game is hectic and provides a fun gameplay loop.
                    </p>
                        </div>
                        <img class='rounded-md shadow-xl self-center' src="{{ route('image.website', 'The Garbage Man of New Trash City Title.jpeg') }}"/>
                    </div>
                    
                    <ul class='list-disc ml-5 text-gray-300'>
                        <li>
                            <strong class='font-semibold text-white'>Developed as a team</strong> of 2 programmers and 5 artists/sound designers using Godot 4 for development and Git for version control with a strict time limit of 72 hours.
                        </li>
                        <li>
                            <strong class='font-semibold text-white'>Communicated</strong> across the whole team to follow the group vision whilst efficiently managing time for the required features.
                        </li>
                        <li>
                            <strong class='font-semibold text-white'>Published</strong> both games with original gameplay loop, voxel/pixel art and sound effects.
                        </li>
                    </ul>
                </div>
                <div class='group relative bg-gray-900 border-1 border-gray-100 p-8 my-4'>
                    <a href="/recipes" target="_blank">
                        <h3 class='text-white'>Laravel Website</h4>
                        <img src="{{ route('image.website', 'The Garbage Man of New Trash City Title.jpeg') }}"/>
                    </a>
                    <h5>Recipe Social Media Site</h5>
                    <p>
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
        </section>
        <h3>Education</h3>
        <section class='bg-gray-900 border-1 border-gray-100 p-8 my-4'>
            <p><strong>Diploma of Higher Education (Mathematics):</strong> Lancaster University	2018 - 2021</p>
        </section>
        <h3>Interests</h3>
        <section class='bg-gray-900 border-1 border-gray-100 p-8 my-4'>
            <p>Avid motorcyclist and amateur mechanic. Currently fixing up a non-running 1994 BMW motorcycle.</p>
            <p>Hobbyist mead brewer, cooking enthusiast and novice handyman.</p>
        </section>
    </div>
</x-layout>