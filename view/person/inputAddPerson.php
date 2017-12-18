<section>
    <div class="sectionHeader">General information</div>
    
    <div class="sectionBody">
        <dl>
            <dt>Firstname:</dt>
            <dd><input type="text" name="firstname" required /></dd>
            <dt>Name:</dt>
            <dd><input type="text" name="name" required /></dd>
            <dt>Birthdate (Y / M / D):</dt>
            <dd>
                <input type="number" name="birthdateYear" id="randomBirthdateYear" class="size4" min="2000" required /> /
                <input type="number" name="birthdateMonth" id="randomBirthdateMonth" class="size2" min="1" max="12" required /> /
                <input type="number" name="birthdateDay" id="randomBirthdateDay" class="size2" min="1" max="31" required />
                <a href="#" id="generateRandomDate">(generate)</a>
            </dd>
            <dt>Formation:</dt>
            <dd><input type="text" name="formation" required /></dd>
            <dt>Nationality:</dt>
            <dd><input type="text" name="nationality" required /></dd>
            <dt>Height (m):</dt>
            <dd><input type="text" name="height" class="size4" required /></dd>
            <dt>Weight (kg):</dt>
            <dd><input type="number" name="weight" class="size3" min="50" required /></dd>
        </dl>
    </div>
</section>