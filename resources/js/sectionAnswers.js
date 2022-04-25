window.addEventListener('load', () => {
    new SectionAnswers();
});

class SectionAnswers {
    sectionsContainer;
    questionsContainer;
    questions;
    maxStringLength;
    isDeleting;

    constructor() {
        this.sectionsContainer = document.getElementById('sections');
        this.questionsContainer = document.getElementById('questions');
        this.questions = [];
        this.maxStringLength = 40;
        this.isDeleting = false;
        this.initSections();
    }

    initSections() {
        if (window.values) {
            window.values.forEach(section => {
                const displaySection = this.createSection(section);
                this.sectionsContainer.append(displaySection);
                this.initQuestions(section);
            });
        }
    }

    createSection(section) {
        const displaySection = document.createElement('div');
        displaySection.className = 'section-button';
        displaySection.append(
            this.createLeftSide(section.title, section.description)
        );
        displaySection.append(this.createRightSide());
        displaySection.addEventListener('click', async e => {
            e.preventDefault();
            const oldSelectedSection =
                document.getElementsByClassName('selected');
            if (oldSelectedSection.length > 0) {
                oldSelectedSection[0].classList.remove('selected');
            }
            displaySection.classList.add('selected');
            await this.displayQuestions(section.id);
        });
        return displaySection;
    }

    initQuestions(section) {
        this.questions[section.id] = [];
        section.questions.forEach(question => {
            const displayQuestion = this.createQuestion(section.id, question);
            this.questions[section.id].push(displayQuestion);
            this.questionsContainer.append(displayQuestion);
        });
    }

    createQuestion(sectionId, question) {
        const displayQuestion = document.createElement('a');
        displayQuestion.href = `${window.url}/${sectionId}/questions/${question.id}/answers`;
        displayQuestion.className = 'question-button';
        displayQuestion.hidden = true;
        displayQuestion.setAttribute('name', 'question' + sectionId);
        displayQuestion.append(
            this.createLeftSide(
                question.title,
                'Aantal antwoorden: ' + question.amountOfAnswers
            )
        );
        displayQuestion.append(this.createRightSide());
        return displayQuestion;
    }

    createLeftSide(title, description) {
        description = description ? description : '';
        const left = document.createElement('div');
        left.className = 'col';
        const displayTitle = document.createElement('p');
        displayTitle.className = 'm-0 mb-2';
        displayTitle.textContent = title;
        const displayDescription = document.createElement('p');
        displayDescription.className = 'small m-0 small-height';
        displayDescription.textContent =
            description.length <= this.maxStringLength
                ? description
                : description.substring(0, this.maxStringLength) + '...';
        left.append(displayTitle, displayDescription);
        return left;
    }

    createRightSide() {
        const right = document.createElement('div');
        right.className = 'd-flex justify-content-end align-items-center';
        right.innerHTML = `
         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 className="bi bi-chevron-right float-end" viewBox="0 0 16 16">
                <path fill-rule="evenodd" stroke="currentColor" stroke-width="1"
                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        `;
        return right;
    }

    async displayQuestions(sectionId) {
        this.isDeleting = true;
        for (const question of Array.from(
            document.querySelectorAll('.question-button.show')
        ).reverse()) {
            question.hidden = true;
            question.classList.add('remove');
            await this.delay(50);
        }
        this.isDeleting = false;
        const questions = document.getElementsByName('question' + sectionId);
        for (const question of questions) {
            if (this.isDeleting) {
                break;
            }
            question.hidden = false;
            question.classList.add('show');
            await this.delay(50);
        }
    }

    delay(delayInms) {
        return new Promise(resolve => {
            setTimeout(() => {
                resolve(2);
            }, delayInms);
        });
    }
}
