const addAssertion = document.getElementById("addAssertion")
const assertions = document.getElementById('assertions')

addAssertion.addEventListener('click', function(){
    const li = document.createElement('li');
    li.setAttribute('class', 'mb-3 flex justify-between items-center')

    const assertionInput = document.createElement('input');

    assertionInput.setAttribute('name', 'assertions[]');
    assertionInput.setAttribute('type', 'text');
    assertionInput.setAttribute('placeholder', 'Type assertion content');
    assertionInput.setAttribute('class', 'w-11/12');

    li.appendChild(assertionInput)

    assertions.appendChild(li)
});


const contentQCM = document.getElementById('contentQCM')

contentQCM.addEventListener('keyup', function()
{
    if (contentQCM.value.length > 5) {
        addAssertion.classList.remove('hidden')
        document.getElementById('createQCM-Button').classList.remove('hidden');
    } else {
        addAssertion.classList.add('hidden')
        document.getElementById('createQCM-Button').classList.add('hidden');
    }
})