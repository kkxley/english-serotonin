<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateThemeTable extends AbstractMigration
{
    public function change(): void
    {
        $theme = $this->table('theme', ['id' => false, 'primary_key' => 'theme_id']);
        $theme->addColumn('theme_id', 'integer', ['limit' => 11, 'null' => false, 'identity' => true, 'comment' => 'id темы'])
            ->addColumn('title', 'string', ['limit' => 255, 'null' => false, 'comment' => 'Название темы'])
            ->addColumn('description', 'string', ['limit' => 255, 'null' => false, 'default' => '', 'comment' => 'Описание'])
            ->addColumn('path', 'string', ['limit' => 255, 'null' => false, 'comment' => 'Путь темы'])
            ->addColumn('parent_id', 'integer', ['limit' => 11, 'null' => false, 'default' => 0, 'comment' => 'Родительская тема'])
            ->addColumn('formula_simple', 'string', ['limit' => 255, 'default' => '', 'comment' => 'Формула утвердительного'])
            ->addColumn('formula_question', 'string', ['limit' => 255, 'default' => '', 'comment' => 'Формула вопросительного'])
            ->addColumn('examples', 'string', ['limit' => 1024, 'default' => '', 'comment' => 'Примеры'])
            ->create();

        $theme->insert([
            'title' => 'Past',
            'path' => 'past',
        ])->insert([
            'title' => 'Present',
            'path' => 'present',
        ])->insert([
            'title' => 'Future',
            'path' => 'future',
        ])->insert([ // Past
            'title' => 'Simple',
            'description' => 'Прошедшее время, которое используется для обозначения действий, происходивших в прошлом и уже завершившихся.',
            'parent_id' => 1,
            'path' => 'past-simple',
            'formula_simple' => '[субъект] + [-ed] (для правильных глаголов) или [2-ая форма глагола] (для неправильных глаголов)',
            'formula_question' => '[Did] + [субъект] + [основа глагола] (для всех глаголов)?',
            'examples' => 'Did you walk to the store yesterday?|I walked to the store yesterday.|She ate breakfast an hour ago.'
        ])->insert([
            'title' => 'Continuous',
            'description' => 'Прошедшее время, которое используется для обозначения длительного действия в прошлом, которое происходило в определенный момент времени или в течение какого-то временного периода',
            'parent_id' => 1,
            'path' => 'past-continuous',
            'formula_simple' => '[субъект] + [was/were] + [-ing форма глагола]',
            'formula_question' => '[was/were] + [субъект] + [основа глагола с окончанием -ing]',
            'examples' => 'I was walking to the store when I saw a friend.|They were playing tennis at the park yesterday.|Was he working late last night?',
        ])->insert([
            'title' => 'Perfect',
            'description' => 'прошедшее совершенное время, которое используется для обозначения завершенного действия в прошлом, которое произошло до другого действия в прошлом.',
            'parent_id' => 1,
            'path' => 'past-perfect',
            'formula_simple' => '[субъект] + [had] + [3-я форма глагола]',
            'formula_question' => '[had] + [субъект] + [3-я форма глагола] + [дополнение]?',
            'examples' => 'I had already eaten breakfast before I left the house. (Я уже съел завтрак, когда вышел из дома.)|They had finished their homework by the time their friends arrived. (Они закончили свою домашнюю работу, когда пришли их друзья.)|Had they finished the project by the deadline? (Они закончили проект к дедлайну?)',
        ])->insert([
            'title' => 'Perfect Continuous',
            'description' => 'Прошедшее совершенное длительное время, которое используется для обозначения действия, которое началось и продолжалось до определенного момента в прошлом и уже было завершено к этому моменту.',
            'parent_id' => 1,
            'path' => 'past-perfect-continuous',
            'formula_simple' => '[субъект] + [had been] + [глагол с окончанием -ing]',
            'formula_question' => '[had] + [субъект] + [been] + [глагол с окончанием -ing] + [дополнение]?',
            'examples' => 'I had been studying Spanish for two years before I moved to Madrid. (Я учил испанский язык два года до того, как переехал в Мадрид.)|They had been waiting for the bus for over an hour before it finally arrived. (Они ждали автобус более часа, прежде чем он наконец прибыл.)|Had you been working for the company for long before you were promoted? (Ты долго работал в этой компании, прежде чем тебя повысили?)'
        ])->insert([ // Present
            'title' => 'Simple',
            'description' => "Настоящее простое время, которое используется для обозначения регулярных действий, фактов, общих правил, состояний и других событий, которые происходят в настоящее время или регулярно повторяются.",
            'parent_id' => 2,
            'path' => 'present-simple',
            'formula_simple' => '[субъект] + [основа глагола] (+[s/es для 3-го лица ед.ч.)]',
            'formula_question' => '[Вспомогательный глагол do/does] + [субъект] + [основа глагола] + ...?',
            'examples' => 'I eat breakfast at 7 a.m. every day. (Я завтракаю в 7 утра каждый день.)|She studies English at the language school. (Она изучает английский язык в языковой школе.)|Do you like coffee? (Ты любишь кофе?)'
        ])->insert([
            'title' => 'Continuous',
            'description' => "Настоящее длительное время, которое используется для обозначения действия, которое происходит в настоящее время и продолжается в данный момент речи",
            'parent_id' => 2,
            'path' => 'present-continuous',
            'formula_simple' => '[субъект] + [вспомогательный глагол to be в настоящем времени (am/is/are)] + [глагол с окончанием -ing]',
            'formula_question' => '[Вспомогательный глагол to be в настоящем времени (am/is/are)] + [субъект] + [глагол с окончанием -ing] + ...?',
            'examples' => 'I am eating breakfast right now. (Я сейчас завтракаю.)|Are you watching TV right now? (Ты сейчас смотришь телевизор?)|Is she working on her project? (Она работает над своим проектом?)'
        ])->insert([
            'title' => 'Perfect',
            'description' => "Настоящее совершенное время, которое используется для обозначения завершенного действия в прошлом, которое имеет связь с настоящим",
            'parent_id' => 2,
            'path' => 'present-perfect',
            'formula_simple' => '[субъект] + [вспомогательный глагол "to have" в настоящем времени (have/has)] + [прошедшая форма глагола (V3)]',
            'formula_question' => '[Вспомогательный глагол "to have" в настоящем времени (have/has)] + [субъект] + [прошедшая форма глагола (V3)] + ...?',
            'examples' => 'I have seen that movie before. (Я видел этот фильм раньше.)|She has lived in this city for five years. (Она живет в этом городе уже пять лет.)|Have you ever been to Paris? (Ты когда-нибудь был в Париже?)'
        ])->insert([
            'title' => 'Perfect Continuous',
            'description' => "Настоящее совершенное длительное время, которое используется для обозначения действия, которое началось в прошлом и продолжается в настоящее время",
            'parent_id' => 2,
            'path' => 'present-perfect-continuous',
            'formula_simple' => '[субъект] + [вспомогательный глагол "to have" в соответствующем времени (have/has)] + [быть в форме причастия настоящего времени (been)] + [глагол с окончанием -ing]',
            'formula_question' => '[Вспомогательный глагол "to have" в соответствующем времени (have/has)] + [субъект] + [быть в форме причастия настоящего времени (been)] + [глагол с окончанием -ing] + [?]',
            'examples' => 'They have been waiting for over an hour. (Они ждали уже более часа.)|She has been studying English for five years. (Она изучает английский язык уже пять лет.)|Have they been waiting for over an hour? (Они ждут уже более часа?)'
        ])->insert([ // Future
            'title' => 'Simple',
            'description' => 'Будущее простое время, которое используется для обозначения действия, которое произойдет в будущем и не зависит от других обстоятельств. ',
            'parent_id' => 3,
            'path' => 'future-simple',
            'formula_simple' => '[Субъект] + [will/shall] + [глагол в инфинитиве без "to"]',
            'formula_question' => '[Will/Shall] + [субъект] + [глагол в инфинитиве без "to"] + [остальная часть предложения]',
            'examples' => 'I will study harder next semester. (Я буду учиться усерднее в следующем семестре.)|I will study harder next semester. (Я буду учиться усерднее в следующем семестре.)|Will you attend the party tonight? (Ты будешь на вечеринке сегодня вечером?)'
        ])->insert([
            'title' => 'Continuous',
            'description' => 'Будущее длительное время, которое используется для обозначения действия, которое будет происходить в определенный момент в будущем и продолжится в течение некоторого времени.',
            'parent_id' => 3,
            'path' => 'future-continuous',
            'formula_simple' => '[Субъект] + [will be] + [глагол с окончанием -ing]',
            'formula_question' => '[Will] + [субъект] + [be] + [глагол с окончанием -ing] + [?]',
            'examples' => 'I will be studying all evening. (Я буду учиться всю ночь.)|They will be traveling to Europe next month. (Они будут путешествовать в Европу в следующем месяце.)|Will you be studying all evening? (Будешь ли ты учиться всю ночь?)'
        ])->insert([
            'title' => 'Perfect',
            'description' => 'Будущее совершенное время, которое используется для обозначения завершенного действия к определенному моменту в будущем.',
            'parent_id' => 3,
            'path' => 'future-perfect',
            'formula_simple' => '[Will have] + [глагол в прошедшем времени (Past Participle)] + [существительное или местоимение в качестве субъекта]',
            'formula_question' => '[Will] + [существительное или местоимение в качестве субъекта] + [have] + [глагол в прошедшем времени (Past Participle)]',
            'examples' => 'By next year, he will have graduated from university. (К следующему году он закончит университет.)|Will you have finished the project by tomorrow? (Закончишь ли ты проект к завтрашнему дню?)|Will she have finished the book by next week? (Закончит ли она книгу к следующей неделе?)'
        ])->insert([
            'title' => 'Perfect Continuous',
            'description' => 'Будущее совершенное длительное время, которое используется для обозначения действия, которое начнется в будущем и продолжится до определенного момента в будущем.',
            'parent_id' => 3,
            'path' => 'future-perfect-continuous',
            'formula_simple' => '[subject] + will have been + [verb] + -ing.',
            'formula_question' => 'Will + [subject] + have been + [verb] + -ing + [time expression]?',
            'examples' => 'I will have been working for 8 hours by 5 pm.|Will you have been studying for 2 hours by 7 pm?'
        ])->save();
    }
}
