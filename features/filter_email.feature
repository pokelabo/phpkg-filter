Feature: TrimFilter

  Scenario Outline: EmailFilter
    When "email"フィルタに"<option_map>"を設定して値"<value>"をフィルタする
    Then フィルタの結果は"<result>"である

    Examples:
    | value                    | option_map                            | result                 | comment                   |
    | 'test@example.com'       |                                       | test@example.com       | not to be modified        |
    | 'test+alias@example.com' |                                       | test+alias@example.com | not to be modified        |
    | 'test+alias@example.com' | {strip_alias: true}                   | test@example.com       | alias to be stripped      |
    | '+alias@example.com'     | {strip_alias: true}                   | @example.com           | results invalid format... |
    | 'aーb@example.com'       |                                       | a-b@example.com        | default normalize: true   |
    | 'aーb@example.com'       | {normalize: true}                     | a-b@example.com        |                           |
    | 'aーb@example.com'       | {normalize: false}                    | aーb@example.com       |                           |
    | 'aーb+ab@example.com'    | {normalize: false, strip_alias: true} | aーb@example.com       |                           |

