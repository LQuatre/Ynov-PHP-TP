<h1>Create Your CV</h1>
<form action="cv_create.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" required>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>

    <label for="education">Education:</label>
    <textarea id="education" name="education" required></textarea>

    <label for="experience">Experience:</label>
    <textarea id="experience" name="experience" required></textarea>

    <label for="skills">Skills:</label>
    <textarea id="skills" name="skills" required></textarea>

    <button type="submit" class="cta-button">Submit</button>
</form>