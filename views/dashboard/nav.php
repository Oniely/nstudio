
<div class="md:w-full md:pt-[2rem] flex flex-col gap-1 pt-[3.1rem] transition-all delay-75 ease-linear">
    <h1 class="text-xl font-semibold px-2 md:px-0">Account</h1>
    <div class="flex flex-col gap-1">
        <a class="rounded py-1 text-start px-2 md:px-0 w-[8rem] relative <?= @$profile ? 'font-medium underline' : '' ?>" href="profile.php">Profile</a>
        <a class="rounded py-1 text-start px-2 md:px-0 w-[8rem] relative <?= @$purchases ? 'font-medium underline' : '' ?>" href="purchases.php">My Purchases</a>
        <a class="rounded py-1 text-start px-2 md:px-0 w-[8rem] relative <?= @$address ? 'font-medium underline' : '' ?>" href="address.php">Address</a>
        <a class="rounded py-1 text-start px-2 md:px-0 w-[8rem] relative" href="/nstudio/includes/logout.php">Sign Out</a>
    </div>
</div>

<!-- before:content-[''] before:w-[0%] before:hover:w-[38%] before:hover:h-[2px] before:absolute before:bottom-2 before:bg-black hover:bg-slate-100 transition-all delay-75 ease-linear
before:content-[''] before:w-[0%] before:hover:w-[81%] before:hover:h-[2px] before:absolute before:bottom-2 before:bg-black hover:bg-slate-100 transition-all delay-75 ease-linear
before:content-[''] before:w-[0%] before:hover:w-[60%] before:hover:h-[2px] before:absolute before:bottom-2 before:bg-black hover:bg-slate-100 transition-all delay-75 ease-linear
before:content-[''] before:w-[0%] before:hover:w-[50%] before:hover:h-[2px] before:absolute before:bottom-2 before:bg-black hover:bg-slate-100 transition-all delay-75 ease-linear -->