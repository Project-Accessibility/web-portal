window.addEventListener('load', () => {
    new SectionAnswers();
});

class SectionAnswers {
    sectionsContainer;
    questionsContainer;
    questions;
    noQuestionsText;
    answersContainer;
    answers;
    noAnswersText;
    maxStringLength;
    isDeleting;

    constructor() {
        this.sectionsContainer = document.getElementById('sections');
        this.questionsContainer = document.getElementById('questions');
        this.questions = [];
        this.noQuestionsText = document.getElementById('noQuestions');
        this.answersContainer = document.getElementById('answers');
        this.answers = [];
        this.noAnswersText = document.getElementById('noAnswers');
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
        displaySection.className = 'result-button';
        displaySection.append(
            this.createLeftSide(section.title, section.description)
        );
        displaySection.append(this.createRightSide());
        displaySection.addEventListener('click', async e => {
            e.preventDefault();
            const oldSelectedButtons =
                document.getElementsByClassName('selected');
            if (oldSelectedButtons.length > 0) {
                Array.from(oldSelectedButtons).forEach(oldSelectedButton => {
                    oldSelectedButton.classList.remove('selected');
                });
            }
            displaySection.classList.add('selected');
            await this.displayQuestions(section.id);
        });
        return displaySection;
    }

    initQuestions(section) {
        this.questions[section.id] = [];
        const questions = [];
        Object.keys(section.questions).forEach(id => {
            questions.push(section.questions[id]);
        });
        questions.forEach(question => {
            const displayQuestion = this.createQuestion(section.id, question);
            this.questions[section.id].push(displayQuestion);
            this.questionsContainer.append(displayQuestion);
            this.initAnswers(section, question);
        });
    }

    createQuestion(sectionId, question) {
        const displayQuestion = document.createElement('a');
        displayQuestion.className = 'result-button question';
        displayQuestion.hidden = true;
        displayQuestion.setAttribute('name', 'question' + sectionId);
        displayQuestion.append(
            this.createLeftSide(question.title, question.question)
        );
        displayQuestion.append(this.createRightSide());
        displayQuestion.addEventListener('click', async e => {
            e.preventDefault();
            const oldSelectedQuestion =
                document.getElementsByClassName('selected');
            if (oldSelectedQuestion.length > 1) {
                oldSelectedQuestion[1].classList.remove('selected');
            }
            displayQuestion.classList.add('selected');
            await this.displayAnswers(question.id);
        });
        return displayQuestion;
    }

    initAnswers(section, question) {
        this.answers[question.id] = [];
        question.answers.forEach(answer => {
            const displayAnswer = this.createAnswer(
                section.id,
                question.id,
                answer
            );
            this.answers[question.id].push(displayAnswer);
            this.answersContainer.append(displayAnswer);
        });
    }

    createAnswer(sectionId, questionId, answer) {
        const displayAnswer = document.createElement('a');
        displayAnswer.href = `${window.url}/${sectionId}/questions/${answer.question_id}/answer/${answer.participant_id}`;
        displayAnswer.className = 'result-button answer';
        displayAnswer.hidden = true;
        displayAnswer.setAttribute('name', 'answer' + questionId);
        displayAnswer.append(
            this.createLeftSide('Participant #' + answer.participant.code, '')
        );
        displayAnswer.append(this.createRightSide());
        return displayAnswer;
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
        this.noQuestionsText.hidden = true;
        for (const question of Array.from(
            document.querySelectorAll('.question.show')
        ).reverse()) {
            question.hidden = true;
            question.classList.add('remove');
            await this.delay(50);
        }
        for (const answer of Array.from(
            document.querySelectorAll('.answer.show')
        ).reverse()) {
            answer.hidden = true;
            answer.classList.add('remove');
            await this.delay(50);
        }
        this.isDeleting = false;
        const questions = document.getElementsByName('question' + sectionId);
        if (questions.length === 0) {
            this.noQuestionsText.hidden = false;
            return;
        }
        for (const question of questions) {
            if (this.isDeleting) {
                break;
            }
            question.hidden = false;
            question.classList.add('show');
            await this.delay(50);
        }
    }

    async displayAnswers(questionId) {
        this.isDeleting = true;
        this.noAnswersText.hidden = true;
        for (const answer of Array.from(
            document.querySelectorAll('.answer.show')
        ).reverse()) {
            answer.hidden = true;
            answer.classList.add('remove');
            await this.delay(50);
        }
        this.isDeleting = false;
        const answers = document.getElementsByName('answer' + questionId);
        if (answers.length === 0) {
            this.noAnswersText.hidden = false;
            return;
        }
        for (const answer of answers) {
            if (this.isDeleting) {
                break;
            }
            answer.hidden = false;
            answer.classList.add('show');
            await this.delay(50);
        }
    }

    delay(delayInMs) {
        return new Promise(resolve => {
            setTimeout(() => {
                resolve(2);
            }, delayInMs);
        });
    }
}
