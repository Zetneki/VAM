const lname = document.getElementById('inputLname')
const fname = document.getElementById('inputFname')
const password = document.getElementById('password')
const passwordRepeat = document.getElementById('passwordRep')
const form = document.getElementById('form')
const errorElement = document.getElementById('error')
const container = document.getElementById('container')

form.addEventListener('submit', (e) => {
    let messages = []
    let regex = [/[A-Z]/, /[a-z]/, /[0-9]/]

    if (lname.value === "" || lname.value == null) {
        messages.push('Vezetéknév szükséges!')
    }
    if (fname.value === "" || fname.value == null) {
        messages.push('Keresztnév szükséges!')
        errorElement.innerText = messages.join(', ')
    }
    if (password.value.length < 8) {
        messages.push('A jelszónak legalább 8 karakteresnek lennie!')
    }
    if (!regex[0].test(password.value)) {
        messages.push('A jelszónak tartalmaznia kell legalább egy nagybetűt!')
    }
    if (!regex[1].test(password.value)) {
        messages.push('A jelszónak tartalmaznia kell legalább egy kisbetűt!')
    }
    if (!regex[2].test(password.value)) {
        messages.push('A jelszónak tartalmaznia kell legalább egy számot!')
    }
    if (password.value !== passwordRepeat.value) {
        messages.push('A jelszavaknak meg kell egyezniük!')
    }

    if (messages.length > 0) {
        e.preventDefault()
        container.classList.remove('container')
        container.classList.add('container-fluid')
        errorElement.innerText = messages.join('\n')
    }
})